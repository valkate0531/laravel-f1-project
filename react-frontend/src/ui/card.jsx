function Card({ name, description }) {
    return (
        <section className="card">
            <h2>{name}</h2>
            <p>{description}</p>
        </section>
    );
}

export default Card;
