import React, { useEffect, useState } from "react";
import left_img from "../assets/images/left_img.jpg";
import right_img from "../assets/images/image-right.png";
import axios from "axios";
import { shallowEqual, useSelector } from "react-redux";
import { BASE_URL } from "../../config";
import { toast } from "react-toastify";
import { useLocation } from "react-router-dom";

import whtsapp_icn from "../assets/images/whtsapp_icn.png";

export default function ContactSection() {
  const location = useLocation();
  const { siteData } = useSelector(
    (state) => ({
      siteData: state.data.siteData,
    }),
    shallowEqual,
  );
  const [formData, setFormData] = useState({
    name: "",
    phone: "",
    email: "",
    message: "",
  });

  const [errors, setErrors] = useState({});
  let [disable, setDisable] = useState(false);
  const handleChange = (e) => {
    const { name, value } = e.target;

    if (name === "phone") {
      // Only digits & max 10
      if (!/^\d*$/.test(value)) return;
      if (value.length > 10) return;
    }

    if (name === "message") {
      // Limit message to 250 characters
      if (value.length > 250) return;
    }

    setFormData({
      ...formData,
      [name]: value,
    });
  };

  const validate = () => {
    let newErrors = {};

    if (!formData.name.trim()) {
      newErrors.name = "Name is required";
    } else if (!/^[A-Za-z]+(?:\s[A-Za-z]+)*$/.test(formData.name.trim())) {
      newErrors.name = "Name should contain only letters and spaces";
    } else if (formData.name.trim().length < 2) {
      newErrors.name = "Name must be at least 2 characters";
    }
    if (!formData.phone.trim()) newErrors.phone = "Phone number is required";
    if (formData.phone.trim() && formData.phone.length != 10)
      newErrors.phone = "Valid phone number is required";
    if (!formData.email.trim()) newErrors.email = "Email address is required";
    if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(formData.email))
      newErrors.email = "Enter a valid email address";
    if (!formData.message.trim()) newErrors.message = "Message is required";

    setErrors(newErrors);
    return Object.keys(newErrors).length === 0;
  };

  const handleSubmit = async (e) => {
    e.preventDefault();

    if (!validate()) return;

    console.log("Form Submitted:", formData);

    setDisable(true);
    await axios
      .post(`${BASE_URL}/contact-us-save`, {
        name: formData.name,
        email: formData.email,
        contact_no: formData.phone,
        inquiry: formData.message,
      })
      .then((res) => {
        setDisable(false);
        if (res.data.status === 1) {
          toast.success(
            "Thank you for reaching out to us. We will review your message and get back to you shortly.",
          );
          setDisable(false);
          setFormData({
            name: "",
            phone: "",
            email: "",
            message: "",
          });
        } else {
          toast.error(res.data.response);
        }
      })
      .catch((error) => {
        setDisable(false);
        toast.error(error.response.data.response);
        console.log(error);
      });
  };
  const handleWhatsApp = () => {
    const phone = siteData.additionalphonenumber; // your number with country code (India = 91)
    // const message = "Hello, I want to inquire about your services";

    const url = `https://wa.me/${phone}`;

    window.open(url, "_blank"); // ✅ opens in new tab
  };
  useEffect(() => {
    setFormData({
      name: "",
      phone: "",
      email: "",
      message: "",
    });
    setErrors({});
  }, [location]);
  return (
    <div className="sec_five" id="contact-section">
      <div className="container-fluid g-0">
        <div className="row g-0">
          {/* Left Image */}
          <div className="col-lg-5">
            <div className="sec_five_left">
              <img src={left_img} alt="contact" className="img-fluid" />
            </div>
          </div>

          {/* Right Section */}
          <div className="col-lg-7">
            <div
              className="sec_five_right"
              style={{
                background: `#454b36 url(${right_img}) no-repeat`,
              }}
            >
              <div className="bx_item_set">
                <h2>Let’s get in touch</h2>
                <p>Have a question about Paarcel? Contact us anytime.</p>
                <p>
                  पार्सल के बारे में कोई प्रश्न है? हमसे कभी भी संपर्क करें।
                </p>
                <div className="formItem">
                  <form onSubmit={handleSubmit}>
                    <div className="row">
                      <div className="col-6">
                        <div className="mb-3">
                          <input
                            type="text"
                            placeholder="Name*"
                            className="form-control"
                            name="name"
                            value={formData.name}
                            onChange={handleChange}
                          />
                          {errors.name && (
                            <small className="text-danger">{errors.name}</small>
                          )}
                        </div>
                      </div>
                      <div className="col-6">
                        <div className="mb-3">
                          <input
                            type="tel"
                            placeholder="Phone*"
                            className="form-control"
                            name="phone"
                            value={formData.phone}
                            onChange={handleChange}
                          />
                          {errors.phone && (
                            <small className="text-danger">
                              {errors.phone}
                            </small>
                          )}
                        </div>
                      </div>
                    </div>

                    <div className="mb-3">
                      <input
                        type="email"
                        placeholder="Email"
                        className="form-control"
                        name="email"
                        value={formData.email}
                        onChange={handleChange}
                      />
                      {errors.email && (
                        <small className="text-danger">{errors.email}</small>
                      )}
                    </div>

                    <div className="mb-3">
                      <textarea
                        className="form-control"
                        rows="3"
                        placeholder="Your Message"
                        name="message"
                        value={formData.message}
                        onChange={handleChange}
                      />
                      {errors.message && (
                        <small className="text-danger">{errors.message}</small>
                      )}
                    </div>
                    <div className="d-flex btncontent">
                      <button
                        type="submit"
                        name="formsubmit"
                        className="btn btn-primary"
                      >
                        {!disable ? (
                          <span>Submit</span>
                        ) : (
                          <span id="loading">
                            <span>&bull;</span>
                            <span>&bull;</span>
                            <span>&bull;</span>
                          </span>
                        )}
                      </button>
                      {/* <div className="d-flex btncontent"> */}
                      <button
                        type="button"
                        className="btn btn-primary mx-2"
                        onClick={handleWhatsApp}
                      >
                        <span>
                          <i>
                            <img src={whtsapp_icn} alt="" />
                          </i>{" "}
                          WhatsApp Us
                        </span>
                      </button>
                      {/* </div> */}
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
}
