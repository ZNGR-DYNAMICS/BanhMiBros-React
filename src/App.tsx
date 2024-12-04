import React, { useEffect, useState } from 'react';
import { BrowserRouter as Router, Routes, Route } from 'react-router-dom';
import Home from './components/Home';
import AddEntry from './pages/AddEntry';

const App: React.FC = () => {
    const [,setData] = useState<string>('');

    useEffect(() => {
        fetch('./databaseList.php')
            .then(response => response.text())
            .then(setData)
            .catch(err => console.error('Error fetching data:', err));
    }, []);

    return (
        <Router>
            <Routes>
                <Route path="/" element={<Home/>} />
                <Route path="/addentry" element={<AddEntry/>} />
            </Routes>
        </Router>
    );
};

export default App;