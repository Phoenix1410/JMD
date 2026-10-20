import { useEffect, useState } from "react";
import PhoneInput, { isValidPhoneNumber } from "react-phone-number-input";
import "react-phone-number-input/style.css";

import trackingimge from "../../assets/images/trackingimge.jpg";
import trackingBack from "../../assets/images/trackingBack.jpg";
import axios from "axios";
import { BASE_URL } from "../../../config";
import { toast } from "react-toastify";

const TrackingForm = ({
  setResult,
  formData,
  setFormData,
  formRef,
  progessRef,
}) => {
  const [errors, setErrors] = useState({});
  const [loading, setLoading] = useState(false);

  const handleChange = (e) => {
    const value = e.target.value;

    // Allow only digits
    if (!/^\d*$/.test(value)) return;

    setFormData({
      ...formData,
      trackingId: value,
    });
  };

  const validate = () => {
    let newErrors = {};

    if (!formData.trackingId.trim()) {
      newErrors.trackingId = "Tracking ID is required";
    }

    // if (!formData.phone) {
    //   newErrors.phone = "Mobile number is required";
    // } else
    if (formData.phone && !isValidPhoneNumber(formData.phone)) {
      newErrors.phone = "Invalid mobile number";
    }

    setErrors(newErrors);
    return Object.keys(newErrors).length === 0;
  };

  const handleSubmit = async (e) => {
    e.preventDefault();
    if (!validate()) return;

    try {
      setLoading(true);
      setResult(null);

      const response = await axios.get(`${BASE_URL}/trackingoutput`, {
        params: {
          grn: formData.trackingId,
        },
      });
      if (response.data.status == 1) {
        setResult(response.data);
      } else {
        toast.error(response.data.message);
      }
    } catch (error) {
      alert("Something went wrong!");
    } finally {
      setLoading(false);
    }
  };

  return (
    <div
      ref={formRef}
      className="trackingSec"
      style={{ backgroundImage: `url(${trackingBack})` }}
    >
      <div className="container">
        <div className="trackingpnel">
          <div className="media">
            <div className="trackingimge">
              <img src={trackingimge} alt="Tracking" />
            </div>

            <div className="media-object">
              <div className="presencehding">
                <h2>Track shipments, with ease</h2>
              </div>

              <div className="trackingform">
                <form onSubmit={handleSubmit}>
                  <div className="trakdata">
                    <label>
                      Enter your tracking ID{" "}
                      <span style={{ color: "red" }}>*</span>
                    </label>
                    <input
                      type="text"
                      placeholder="Tracking ID"
                      value={formData.trackingId}
                      onChange={handleChange}
                    />
                    {errors.trackingId && (
                      <small style={{ color: "red" }}>
                        {errors.trackingId}
                      </small>
                    )}
                  </div>

                  {/* <div className="trakdata">
                    <label>Enter your mobile number</label>

                    <div className="nmbergrupe">
                      <PhoneInput
                        international
                        defaultCountry="IN"
                        value={formData.phone}
                        onChange={(value) =>
                          setFormData({ ...formData, phone: value })
                        }
                        className="phoneInputField"
                      />
                    </div>

                    {errors.phone && (
                      <small style={{ color: "red" }}>
                        {errors.phone}
                      </small>
                    )}
                  </div> */}

                  <div className="trakbtns">
                    <input
                      type="submit"
                      value={loading ? "Tracking..." : "Track Your Shipment"}
                      disabled={loading}
                    />
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
};

export default TrackingForm;
