import React, { useState, useEffect } from 'react';
import { Link } from 'react-router-dom';

const ProductList = () => {
    const [products, setProducts] = useState([]);
    const [loading, setLoading] = useState(true);
    const [message, setMessage] = useState({ text: '', type: '' });

    useEffect(() => {
        fetchProducts();
    }, []);

    const fetchProducts = async () => {
        try {
            const response = await fetch('/api/products');
            const result = await response.json();

            if (response.ok) {
                setProducts(result.data.data); // Assuming paginated data
            } else {
                setMessage({ text: 'Erreur lors du chargement des produits', type: 'error' });
            }
        } catch (error) {
            setMessage({ text: 'Une erreur est survenue', type: 'error' });
            console.error('Error:', error);
        } finally {
            setLoading(false);
        }
    };

    const deleteProduct = async (id) => {
        if (!confirm('Êtes-vous sûr de vouloir supprimer ce produit ?')) {
            return;
        }

        try {
            const response = await fetch(`/api/products/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json',
                },
            });

            const result = await response.json();

            if (response.ok) {
                setMessage({ text: 'Produit supprimé avec succès', type: 'success' });
                fetchProducts(); // Refresh the list
            } else {
                setMessage({ text: result.message || 'Erreur lors de la suppression', type: 'error' });
            }
        } catch (error) {
            setMessage({ text: 'Une erreur est survenue', type: 'error' });
            console.error('Error:', error);
        }
    };

    if (loading) {
        return (
            <div className="container mt-5">
                <div className="text-center">
                    <div className="spinner-border" role="status">
                        <span className="visually-hidden">Chargement...</span>
                    </div>
                </div>
            </div>
        );
    }

    return (
        <div className="container mt-5">
            <div className="d-flex justify-content-between align-items-center mb-4">
                <h1>Liste des produits</h1>
                <Link to="/products/create" className="btn btn-primary">
                    Ajouter un produit
                </Link>
            </div>

            {message.text && (
                <div className={`alert alert-${message.type === 'error' ? 'danger' : 'success'}`}>
                    {message.text}
                </div>
            )}

            {products.length === 0 ? (
                <div className="alert alert-info">
                    Aucun produit trouvé. <Link to="/products/create">Ajouter le premier produit</Link>
                </div>
            ) : (
                <div className="row">
                    {products.map((product) => (
                        <div key={product.id} className="col-md-4 mb-4">
                            <div className="card h-100">
                                {product.image && (
                                    <img
                                        src={`/storage/${product.image}`}
                                        className="card-img-top"
                                        alt={product.name}
                                        style={{ height: '200px', objectFit: 'cover' }}
                                    />
                                )}
                                <div className="card-body">
                                    <h5 className="card-title">{product.name}</h5>
                                    <p className="card-text">{product.description}</p>
                                    <p className="card-text">
                                        <strong>Prix:</strong> {product.price} FCFA
                                    </p>
                                    <p className="card-text">
                                        <strong>Quantité:</strong> {product.quantity}
                                    </p>
                                </div>
                                <div className="card-footer">
                                    <Link to={`/products/${product.id}/edit`} className="btn btn-warning btn-sm me-2">
                                        Modifier
                                    </Link>
                                    <button
                                        onClick={() => deleteProduct(product.id)}
                                        className="btn btn-danger btn-sm"
                                    >
                                        Supprimer
                                    </button>
                                </div>
                            </div>
                        </div>
                    ))}
                </div>
            )}
        </div>
    );
};

export default ProductList;