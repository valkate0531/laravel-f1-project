import { useState } from 'react';

const initialForm = {
  employmentType: 'regular',
  positionTier: 'junior',
  daysAbsent: '0',
  minutesLate: '0',
  overtimeHours: '0',
};

const apiUrl = import.meta.env.VITE_PAYROLL_API_URL || 'http://localhost:8000/api/payroll';

function formatCurrency(value) {
  return new Intl.NumberFormat('en-PH', {
    style: 'currency',
    currency: 'PHP',
  }).format(Number(value) || 0);
}

export default function PayrollCalculator() {
  const [form, setForm] = useState(initialForm);
  const [result, setResult] = useState(null);
  const [error, setError] = useState('');
  const [isLoading, setIsLoading] = useState(false);

  function updateField(event) {
    const { name, value } = event.target;
    setForm((current) => ({ ...current, [name]: value }));
    if (name === 'employmentType' && value === 'cos') {
      setForm((current) => ({ ...current, employmentType: value, positionTier: '' }));
    }
    if (name === 'employmentType' && value === 'regular') {
      setForm((current) => ({ ...current, employmentType: value, positionTier: 'junior' }));
    }
  }

  async function calculate(event) {
    event.preventDefault();
    setError('');
    setResult(null);
    setIsLoading(true);

    try {
      const response = await fetch(apiUrl, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', Accept: 'application/json' },
        body: JSON.stringify({
          ...form,
          daysAbsent: Number(form.daysAbsent),
          minutesLate: Number(form.minutesLate),
          overtimeHours: Number(form.overtimeHours),
        }),
      });
      const data = await response.json();
      if (!response.ok) {
        throw new Error(data.error || 'Unable to calculate payroll.');
      }
      setResult(data);
    } catch (requestError) {
      setError(requestError.message || 'Unable to calculate payroll.');
    } finally {
      setIsLoading(false);
    }
  }

  return (
    <section className="calculator-card">
      <form onSubmit={calculate} className="calculator-form">
        <div className="form-grid">
          <label>
            Employment type
            <select name="employmentType" value={form.employmentType} onChange={updateField}>
              <option value="regular">Regular</option>
              <option value="cos">Contract of service</option>
            </select>
          </label>
          <label>
            Position tier
            <select
              name="positionTier"
              value={form.positionTier}
              onChange={updateField}
              disabled={form.employmentType === 'cos'}
            >
              <option value="junior">Junior</option>
              <option value="senior">Senior</option>
            </select>
          </label>
          <label>
            Days absent
            <input min="0" max="22" name="daysAbsent" type="number" value={form.daysAbsent} onChange={updateField} />
          </label>
          <label>
            Minutes late
            <input min="0" name="minutesLate" type="number" value={form.minutesLate} onChange={updateField} />
          </label>
          <label>
            Overtime hours
            <input min="0" name="overtimeHours" type="number" step="0.25" value={form.overtimeHours} onChange={updateField} />
          </label>
        </div>
        <button type="submit" disabled={isLoading}>
          {isLoading ? 'Calculating…' : 'Calculate payroll'}
        </button>
        {error && <p className="error-message" role="alert">{error}</p>}
      </form>

      {result && (
        <div className="results" aria-live="polite">
          <div className="net-pay">
            <span>Net pay</span>
            <strong>{formatCurrency(result.netPay)}</strong>
          </div>
          <dl className="result-list">
            <div><dt>Base salary</dt><dd>{formatCurrency(result.baseSalary)}</dd></div>
            <div><dt>Gross pay</dt><dd>{formatCurrency(result.grossPay)}</dd></div>
            <div><dt>Overtime pay</dt><dd>{formatCurrency(result.overtimePay)}</dd></div>
            <div><dt>Absent deduction</dt><dd>{formatCurrency(result.absentDeduction)}</dd></div>
            <div><dt>Late deduction</dt><dd>{formatCurrency(result.lateDeduction)}</dd></div>
            <div><dt>Total deductions</dt><dd>{formatCurrency(result.totalDeductions)}</dd></div>
          </dl>
        </div>
      )}
    </section>
  );
}
