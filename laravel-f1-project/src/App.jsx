import PayrollCalculator from './components/PayrollCalculator.jsx';

export default function App() {
  return (
    <main className="app-shell">
      <section className="hero">
        <p className="eyebrow">Human resources</p>
        <h1>Payroll calculator</h1>
        <p className="hero-copy">
          Calculate monthly pay, deductions, and overtime in one place.
        </p>
      </section>
      <PayrollCalculator />
    </main>
  );
}
