export default function Button({ children, onClick, type = 'button'}) {
    return (
        <button className="primary-button" type={type} onClick={onClick}>
            {children}
        </button>
    );
}