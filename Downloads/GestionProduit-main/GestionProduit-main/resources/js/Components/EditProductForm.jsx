import React, { useState, useEffect } from 'react';
import { useParams, useNavigate } from 'react-router-dom';

const EditProductForm = () => {
    const { id } = useParams();
    const navigate = useNavigate();
    const [formData, setFormData] = useState({
        name: '',
        description: '',
        price: '',
        quantity: '',
        image: null,
        currentImage: ''
    });
    const [message, setMessage] = useState({ text: '', type: '' });
    const [loading, setLoading] = useState(true);

    // Charger les données du produit à modifier
    useEffect(() => {
        const fetchProduct = async () => {
            try {
                const response = await fetch(`/api/products/${id}`);
                const result = await response.json();

                if (response.ok) {
                    setFormData({
                        name: result.data.name,
                        description: result.data.description || '',
                        price: result.data.price,
                        quantity: result.data.quantity,
                        image: null,
                        currentImage: result.data.image 
                            ? `/storage/${result.data.image}` 
                            : ''
                    });
                } else {
                    setMessage({ 
                        text: result.message || 'Erreur lors du chargement du produit', 
                        type: 'error' 
                    });
                }
            } catch (error) {
                setMessage({ 
                    text: 'Une erreur est survenue lors du chargement du produit', 
                    type: 'error' 
                });
                console.error('Error:', error);
            } finally {
                setLoading(false);
            }
        };

        fetchProduct();
    }, [id]);

    const handleChange = (e) => {
        const { name, value, files } = e.target;
        setFormData({
            ...formData,
            [name]: name === 'image' ? files[0] : value
        });
    };

    const handleRemoveImage = () => {
        setFormData({
            ...formData,
            image: null,
            currentImage: '',
            remove_image: true
        });
    };

    const handleSubmit = async (e) => {
        e.preventDefault();
        
        const data = new FormData();
        data.append('_method', 'PUT');
        
        // Ajouter uniquement les champs modifiés
        if (formData.name) data.append('name', formData.name);
        if (formData.description !== undefined) data.append('description', formData.description);
        if (formData.price) data.append('price', formData.price);
        if (formData.quantity) data.append('quantity', formData.quantity);
        if (formData.image) data.append('image', formData.image);
        if (formData.remove_image) data.append('remove_image', true);

        try {
            const response = await fetch(`/api/products/${id}`, {
                method: 'POST', // Utilisation de POST avec _method=PUT pour le support du formulaire
                body: data,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json',
                },
            });

            const result = await response.json();

            if (response.ok) {
                setMessage({ 
                    text: 'Produit mis à jour avec succès!', 
                    type: 'success' 
                });
                
                // Mettre à jour l'image actuelle si une nouvelle image a été téléchargée
                if (result.data.image) {
                    setFormData(prev => ({
                        ...prev,
                        currentImage: `/storage/${result.data.image}`,
                        image: null
                    }));
                }
                
                // Rediriger vers la liste des produits après 2 secondes
                setTimeout(() => {
                    navigate('/');
                }, 2000);
            } else {
                setMessage({ 
                    text: result.message || 'Erreur lors de la mise à jour du produit', 
                    type: 'error' 
                });
                if (result.errors) {
                    console.error('Validation errors:', result.errors);
                }
            }
        } catch (error) {
            setMessage({ 
                text: 'Une erreur est survenue lors de la mise à jour du produit', 
                type: 'error' 
            });
            console.error('Error:', error);
        }
    };

    if (loading) {
        return <div className="text-center my-5">Chargement du produit...</div>;
    }

    return (
        <div className="container mt-5">
            <div className="row justify-content-center">
                <div className="col-md-8">
                    <div className="card">
                        <div className="card-header">Modifier le produit</div>

                        <div className="card-body">
                            {message.text && (
                                <div className={`alert alert-${message.type === 'error' ? 'danger' : 'success'}`}>
                                    {message.text}
                                </div>
                            )}

                            <form onSubmit={handleSubmit}>
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
                                        value={formData.description || ''}
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
                                    <label className="form-label d-block">Image actuelle</label>
                                    {formData.currentImage ? (
                                        <div className="mb-3">
                                            <img 
                                                src={formData.currentImage} 
                                                alt="Image actuelle" 
                                                className="img-thumbnail" 
                                                style={{ maxWidth: '200px', maxHeight: '200px' }}
                                            />
                                            <div className="mt-2">
                                                <button 
                                                    type="button" 
                                                    className="btn btn-sm btn-danger"
                                                    onClick={handleRemoveImage}
                                                >
                                                    Supprimer l'image
                                                </button>
                                            </div>
                                        </div>
                                    ) : (
                                        <p className="text-muted">Aucune image</p>
                                    )}
                                    
                                    <label htmlFor="image" className="form-label">Nouvelle image</label>
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

                                <div className="d-flex justify-content-between">
                                    <button 
                                        type="button" 
                                        className="btn btn-secondary"
                                        onClick={() => navigate('/products')}
                                    >
                                        Annuler
                                    </button>
                                    <button type="submit" className="btn btn-primary" disabled={loading}>
                                        {loading ? 'Enregistrement...' : 'Enregistrer les modifications'}
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

export default EditProductForm;
