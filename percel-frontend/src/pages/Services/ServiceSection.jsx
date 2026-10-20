import React, { useState } from 'react';
import { BASE_IMAGE_URL } from '../../../config';
import { Link } from 'react-router-dom';

const ServiceSection = ({ data = [], page, lastPage, onLoadMore, loading }) => {
  const [selectedService, setSelectedService] = useState(null);
  const [showPopup, setShowPopup] = useState(false);

  const openPopup = (service) => {
    setSelectedService(service);
    setShowPopup(true);
    document.body.style.overflow = 'hidden'; // Prevent background scrolling
  };

  const closePopup = () => {
    setShowPopup(false);
    setSelectedService(null);
    document.body.style.overflow = 'auto'; // Restore scrolling
  };

  return (
    <>
      <div className="presenceNewSec">
        <div className="container">

          <div className="presencehding txtcenter">
            <h2>What We Provide</h2>
            <p>Trusted Logistics Partner</p>
          </div>

          <div className="row">
            {data.map((item) => (
              <div className="col-lg-3 col-sm-6" key={item.id}>
                <div 
                  className="secviceItem"
                  onClick={() => openPopup(item)}
                  style={{ cursor: 'pointer' }}
                >
                  <div className="secviceimge">
                    <img
                      src={`${BASE_IMAGE_URL}/${item.image}`}
                      alt={item.title}
                    />
                  </div>

                  <div className="secviceCont">
                    <figure className='p-2'>
                      <img
                        src={`${BASE_IMAGE_URL}/${item.icon}`}
                        alt={item.title}
                      />
                    </figure>
                    <h3>{item.title}</h3>

                    <span>
                      {item.text?.length > 40
                        ? item.text.substring(0, 40) + "..."
                        : item.text}
                    </span>
                  </div>

                </div>
              </div>
            ))}
          </div>

          {/* ✅ Load More Button */}
          <div className="secvicebtn txtcenter mt-4">
            {page < lastPage && (
              <button
                onClick={onLoadMore}
                className="themebtn"
                disabled={loading}
              >
                {loading ? "Loading..." : "Load More Services"}
              </button>
            )}

            {page === lastPage && (
              <p className="mt-5"></p>
            )}
          </div>
        </div>
      </div>

      {/* Popup Modal */}
      {showPopup && selectedService && (
        <div className="service-popup-overlay" onClick={closePopup}>
          <div className="service-popup-container" onClick={(e) => e.stopPropagation()}>
            <button className="service-popup-close" onClick={closePopup}>&times;</button>
            
            <div className="service-popup-content">
              <div className="service-popup-image">
                <img
                  src={`${BASE_IMAGE_URL}/${selectedService.image}`}
                  alt={selectedService.title}
                />
              </div>
              
              <div className="service-popup-icon">
                <img
                  src={`${BASE_IMAGE_URL}/${selectedService.icon}`}
                  alt={selectedService.title}
                />
              </div>
              
              <h2>{selectedService.title}</h2>
              
              <div className="service-popup-text">
                <p>{selectedService.text}</p>
              </div>
              
              {selectedService.description && (
                <div className="service-popup-description">
                  <h4>Description</h4>
                  <p>{selectedService.description}</p>
                </div>
              )}
              
              {selectedService.features && selectedService.features.length > 0 && (
                <div className="service-popup-features">
                  <h4>Key Features</h4>
                  <ul>
                    {selectedService.features.map((feature, index) => (
                      <li key={index}>{feature}</li>
                    ))}
                  </ul>
                </div>
              )}
              
              {/* <div className="service-popup-footer">
                <Link to={`/services/${selectedService.id}`} className="themebtn">
                  Learn More
                </Link>
                <button onClick={closePopup} className="close-btn">
                  Close
                </button>
              </div> */}
            </div>
          </div>
        </div>
      )}


    </>
  );
};

export default ServiceSection;