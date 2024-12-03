import React, { useEffect, useState } from 'react';

const App: React.FC = () => {
    const [data, setData] = useState<string>('');

    useEffect(() => {
        fetch('/list_databases.php')
            .then(response => response.text())
            .then(setData)
            .catch(err => console.error('Error fetching data:', err));
    }, []);

    return (
        <div>
            <h1>Database Info</h1>
            <div dangerouslySetInnerHTML={{ __html: data }} />
        </div>
    );
};

export default App;