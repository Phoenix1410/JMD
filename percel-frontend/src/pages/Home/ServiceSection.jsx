import React, { useState } from "react";
// import { BASE_IMAGE_URL } from "../../config";
import { BASE_IMAGE_URL } from "../../../config";
import { useNavigate, Link } from "react-router-dom";
import { Interweave } from "interweave";

const ServiceSection = ({ data = [], title = {} }) => {
  const navigate = useNavigate();
  const [selectedService, setSelectedService] = useState(null);
  const [showPopup, setShowPopup] = useState(false);
  console.log(title);

  const openPopup = (service) => {
    setSelectedService(service);
    setShowPopup(true);
    document.body.style.overflow = "hidden"; // Prevent background scrolling
  };

  const closePopup = () => {
    setShowPopup(false);
    setSelectedService(null);
    document.body.style.overflow = "auto"; // Restore scrolling
  };

  return (
    <>
      <div className="secviceSec">
        <div className="container">
          <div className="presencehding txtcenter">
            <h2>{title?.page_title}</h2>
            <p>
              <Interweave content={title?.page_content} />
            </p>
          </div>

          <div className="row">
            {data.map((item) => (
              <div className="col-lg-3 col-sm-6" key={item.id}>
                <div
                  className="secviceItem"
                  onClick={() => openPopup(item)}
                  style={{ cursor: "pointer" }}
                >
                  <div className="secviceimge">
                    <img
                      src={`${BASE_IMAGE_URL}/${item.image}`}
                      alt={item.title}
                    />
                  </div>

                  <div className="secviceCont">
                    <figure className="p-2">
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
          <div className="secvicebtn txtcenter">
            <Link to="/services" className="themebtn">
              View All Services
            </Link>
          </div>
        </div>
      </div>

      {/* Popup Modal */}
      {showPopup && selectedService && (
        <div className="service-popup-overlay" onClick={closePopup}>
          <div
            className="service-popup-container"
            onClick={(e) => e.stopPropagation()}
          >
            <button className="service-popup-close" onClick={closePopup}>
              &times;
            </button>

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

              {/* <div className="service-popup-footer">
                <button onClick={closePopup} className="close-btn">
                  Close
                </button>
              </div> */}
            </div>
          </div>
        </div>
      )}

      {/* Add these styles to your CSS file */}
    </>
  );
};

export default ServiceSection;
