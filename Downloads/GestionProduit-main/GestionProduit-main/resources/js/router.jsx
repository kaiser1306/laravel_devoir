import React from 'react';
import { Routes, Route } from 'react-router-dom';
import Navbar from './Components/Navbar';
import AddProductForm from './Components/AddProductForm';
import EditProductForm from './Components/EditProductForm';
import CreateUserForm from './Components/CreateUserForm';
import ProductList from './Components/ProductList';

const AppRouter = () => {
    return (
        <>
            <Navbar />
            <main className="py-4">
                <Routes>
                    <Route path="/" element={<ProductList />} />
                    <Route path="/products/create" element={<AddProductForm />} />
                    <Route path="/products/:id/edit" element={<EditProductForm />} />
                    <Route path="/users/create" element={<CreateUserForm />} />
                </Routes>
            </main>
        </>
    );
};

export default AppRouter;
