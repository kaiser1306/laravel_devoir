import './bootstrap';
import './bootstrap';
import React from 'react';
import { createRoot } from 'react-dom/client';
import AddProductForm from './Components/AddProductForm';

// Rendre le composant dans l'élément avec l'ID 'add-product-form'
const addProductElement = document.getElementById('add-product-form');
if (addProductElement) {
    const root = createRoot(addProductElement);
    root.render(
        <React.StrictMode>
            <AddProductForm />
        </React.StrictMode>
    );
}
