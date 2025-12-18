import './bootstrap';
import React from 'react';
import { createRoot } from 'react-dom/client';
import { BrowserRouter as Router } from 'react-router-dom';
import AppRouter from './router';

// Rendre l'application dans l'élément avec l'ID 'app'
const appElement = document.getElementById('app');
if (appElement) {
    const root = createRoot(appElement);
    root.render(
        <React.StrictMode>
            <Router>
                <AppRouter />
            </Router>
        </React.StrictMode>
    );
}
