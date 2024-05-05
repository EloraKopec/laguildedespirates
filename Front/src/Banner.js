import React, { useState } from 'react';
import './Banner.css'; // Make sure your CSS styles are properly linked

function Banner() {
  const [showModal, setShowModal] = useState(false);

  const toggleModal = () => setShowModal(!showModal);
  const handleClose = (e) => {
    if (e.target.className === 'modal') {
      setShowModal(false);
    }
  };

  return (
    <div className="banner-container">
      <div className="banner-overlay">
        <h1>La Guilde de barbe noir</h1>
      </div>
      <img src="/img/bateau3.webp" alt="Tavern" className="banner-image" />
      <button className="member-area-btn" onClick={toggleModal}>Espace Membre</button>
      {showModal && (
        <div className="modal" onClick={handleClose}>
          <div className="modal-content">
            <p>Coming Soon !</p>
          </div>
        </div>
      )}
    </div>
  );
}

export default Banner;
