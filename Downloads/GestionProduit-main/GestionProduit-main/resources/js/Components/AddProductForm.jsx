import React, { useState } from 'react';

const AddProductForm = () => {
    const [formData, setFormData] = useState({
        name: '',
        description: '',
        price: '',
        quantity: '',
        image: null
    });
    const [message, setMessage] = useState({ text: '', type: '' });

    const handleChange = (e) => {
        const { name, value, files } = e.target;
        setFormData({
            ...formData,
            [name]: name === 'image' ? files[0] : value
        });
    };

    const handleSubmit = async (e) => {
        e.preventDefault();
        
        const data = new FormData();
        Object.keys(formData).forEach(key => {
            if (formData[key] !== null && formData[key] !== '') {
                data.append(key, formData[key]);
            }
        });

        try {
            const response = await fetch('/api/products', {
                method: 'POST',
                body: data,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json',
                },
            });

            const result = await response.json();

            if (response.ok) {
                setMessage({ text: 'Produit ajouté avec succès!', type: 'success' });
                // Réinitialiser le formulaire
                setFormData({
                    name: '',
                    description: '',
                    price: '',
                    quantity: '',
                    image: null
                });
            } else {
                setMessage({ 
                    text: result.message || 'Erreur lors de l\'ajout du produit', 
                    type: 'error' 
                });
                if (result.errors) {
                    console.error('Validation errors:', result.errors);
                }
            }
        } catch (error) {
            setMessage({ 
                text: 'Une erreur est survenue lors de l\'envoi du formulaire', 
                type: 'error' 
            });
            console.error('Error:', error);
        }
    };

    return (
        <div className="container mt-5">
            <div className="row justify-content-center">
                <div className="col-md-8">
                    <div className="card">
                        <div className="card-header">Ajouter un nouveau produit</div>

                        <div className="card-body">
                            {message.text && (
                                <div className={`alert alert-${message.type === 'error' ? 'danger' : 'success'}`}>
                                    {message.text}
                                </div>
                            )}

                            <form onSubmit={handleSubmit} encType="multipart/form-data">
                                <div className="form-group mb-3">
                                    <label htmlFor="name">Nom du produit</label>
                                    <input
                                        type="text"
                                        className="form-control"
                                        id="name"
                                        name="name"
                                        value={formData.name}
                                        onChange={handleChange}
                                        required
                                    />
                                </div>

                                <div className="form-group mb-3">
                                    <label htmlFor="description">Description</label>
                                    <textarea
                                        className="form-control"
                                        id="description"
                                        name="description"
                                        rows="3"
                                        value={formData.description}
                                        onChange={handleChange}
                                    ></textarea>
                                </div>

                                <div className="row">
                                    <div className="col-md-6">
                                        <div className="form-group mb-3">
                                            <label htmlFor="price">Prix</label>
                                            <div className="input-group">
                                                <input
                                                    type="number"
                                                    step="0.01"
                                                    min="0"
                                                    className="form-control"
                                                    id="price"
                                                    name="price"
                                                    value={formData.price}
                                                    onChange={handleChange}
                                                    required
                                                />
                                                <span className="input-group-text">FCFA</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div className="col-md-6">
                                        <div className="form-group mb-3">
                                            <label htmlFor="quantity">Quantité en stock</label>
                                            <input
                                                type="number"
                                                min="0"
                                                className="form-control"
                                                id="quantity"
                                                name="quantity"
                                                value={formData.quantity}
                                                onChange={handleChange}
                                                required
                                            />
                                        </div>
                                    </div>
                                </div>

                                <div className="form-group mb-4">
                                    <label htmlFor="image" className="form-label">Image du produit</label>
                                    <input
                                        className="form-control"
                                        type="file"
                                        id="image"
                                        name="image"
                                        accept="image/*"
                                        onChange={handleChange}
                                    />
                                    <div className="form-text">
                                        Formats acceptés : JPEG, PNG, JPG, GIF. Taille maximale : 2MB
                                    </div>
                                </div>

                                <div className="d-grid gap-2">
                                    <button type="submit" className="btn btn-primary">
                                        Ajouter le produit
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    );
};

export default AddProductForm;
