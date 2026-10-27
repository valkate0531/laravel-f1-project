const names = [
    'Leanne Graham',
    'Ervin Howell',
    'Clementine Bauch',
    'Patricia Lebsack',
    'Chelsey Dietrich',
    'Mrs. Dennis Schulist',
    'Kurtis Weissnat',
    'Nicholas Runolfsdottir V',
    'Glenna Reichert',
    'Clementina DuBuque',
];

function List() {
    return (
        <ul>
            {names.map((name) => (
                <li key={name}>{name}</li>
            ))}
        </ul>
    );
}

export default List;
