import React from 'react';
import ReactDOM from 'react-dom/client';
import './index.css';
import App from './App';
//import reportWebVitals from './reportWebVitals';

const passwordPrompt = (): void => {
    const validPassword = "test";

    let userPassword = "";

    while (userPassword !== validPassword) {
        userPassword = prompt("Enter the password: ") || "";
        
        if(userPassword === "") {
            alert("Access denied.");
        } else if (userPassword !== validPassword) {
            alert("Incorrect password.")
        }
    }

    alert("Access granted.");
}

passwordPrompt();

const root = ReactDOM.createRoot(
   document.getElementById('root') as HTMLElement
);

root.render(
    <React.StrictMode>
        <App/>
    </React.StrictMode>
)