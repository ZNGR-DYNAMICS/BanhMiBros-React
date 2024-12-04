import React, { useState } from 'react';

const AddEntry: React.FC = () => {
    const [username, setUsername] = useState("");
    const [password, setPassword] = useState("");
    const [message, setMessage] = useState("");

    const handleSubmit = async (e: React.FormEvent) => {
        e.preventDefault();

        try {
            const response = await fetch("./addEntry.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify({ username, password }),
            });
            
            const result = await response.text();
            setMessage(result);

            setUsername("");
            setPassword("");
        } catch (error) {
            console.error("Error submitting form: ", error);
            setMessage("Error adding entry");
        }
    }

    return (
        <div>
            <h1>Add a New Entry</h1>
            <form onSubmit={handleSubmit}>
                <label htmlFor="username">Username:</label>
                <input
                    type="text"
                    id="username"
                    value={username}
                    onChange={(e) => setUsername(e.target.value)}
                    required
                />
                <br />
                <label htmlFor="password">Password:</label>
                <input
                    type="text"
                    id="password"
                    value={password}
                    onChange={(e) => setPassword(e.target.value)}
                    required
                />
                <br />
                <button type="submit">Add Entry</button>
            </form>
            {message && <p>{message}</p>}
        </div>
    );
};

export default AddEntry;