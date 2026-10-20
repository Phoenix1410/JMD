import React, { useEffect, useState } from "react";
import { Banner } from "../../partial/Component/Banner.jsx";
import axios from "axios";
import { BASE_URL } from "../../../config.js";
import { Markup } from "interweave";
import { toast } from "react-toastify";

const Career = () => {
  const [data, setData] = useState([]);
  const [bannerData, setBannerData] = useState({});
  const [selectedJob, setSelectedJob] = useState(null);
  const [errors, setErrors] = useState({});
  const [formData, setFormData] = useState({
    job_id: "",
    applicant_name: "",
    phone_number: "",
    email: "",
    description: "",
    cv: null,
  });

  const fetchData = async () => {
    try {
      const res = await axios.get(`${BASE_URL}/joblists`);
      if (res.data.status === true) {
        setData(res.data.data);
      }
    } catch (error) {
      console.log(error);
    }
  };

  const fetchBanner = async () => {
    try {
      const res = await axios.post(`${BASE_URL}/banner`, { slug: "career" });
      if (res.data.status === 1) {
        setBannerData(res.data.responseData.banner[0] ?? {});
      }
    } catch (error) {
      console.log(error);
    }
  };

  useEffect(() => {
    fetchBanner();
    fetchData();
  }, []);

  const openModal = (job) => {
    setSelectedJob(job);
    setFormData({ ...formData, job_id: job.id });
    // Clear errors when opening modal
    setErrors({});
  };

  const handleChange = (e) => {
    const { name, value, files } = e.target;

    if (name === "cv") {
      setErrors({ ...errors, cv: "" });

      // If no file is selected (user cancelled), don't clear the existing file
      if (!files || files.length === 0) {
        // Do nothing - keep the existing file
        return;
      }

      const file = files[0];

      if (file) {
        const maxSize = 2 * 1024 * 1024; // 2MB

        if (file.size > maxSize) {
          setErrors({ ...errors, cv: "CV file size must be less than 2MB" });
          e.target.value = "";
          return;
        }

        const allowedTypes = ["application/pdf"];

        if (!allowedTypes.includes(file.type)) {
          setErrors({ ...errors, cv: "Only PDF allowed" });
          e.target.value = "";
          return;
        }

        setFormData({ ...formData, cv: file });
      }
    } else if (name === "applicant_name") {
      const lettersOnly = value.replace(/[^A-Za-z\s]/g, "");
      setFormData({ ...formData, applicant_name: lettersOnly });
      // Clear error when user starts typing
      if (errors.applicant_name) {
        setErrors({ ...errors, applicant_name: "" });
      }
    } else if (name === "phone_number") {
      const numbersOnly = value.replace(/[^0-9]/g, "").slice(0, 10);
      setFormData({ ...formData, phone_number: numbersOnly });
      if (errors.phone_number) {
        setErrors({ ...errors, phone_number: "" });
      }
    } else if (name === "email") {
      setFormData({ ...formData, [name]: value });
      if (errors.email) {
        setErrors({ ...errors, email: "" });
      }
    } else {
      setFormData({ ...formData, [name]: value });
      if (errors[name]) {
        setErrors({ ...errors, [name]: "" });
      }
    }
  };

  const validate = () => {
    let newErrors = {};

    if (!formData.applicant_name.trim()) {
      newErrors.applicant_name = "Name is required";
    }

    if (!formData.phone_number.trim()) {
      newErrors.phone_number = "Phone number is required";
    } else if (!/^[0-9]{10}$/.test(formData.phone_number)) {
      newErrors.phone_number = "Enter valid 10 digit phone number";
    }

    if (!formData.email.trim()) {
      newErrors.email = "Email is required";
    } else if (
      !/^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,}$/i.test(formData.email)
    ) {
      newErrors.email = "Invalid email address";
    }

    if (formData.description && formData.description.length > 500) {
      newErrors.description = "Description should be less than 500 characters";
    }

    if (!formData.cv) {
      newErrors.cv = "Please upload your CV";
    } else {
      const allowed = [
        "application/pdf",
        "application/msword",
        "application/vnd.openxmlformats-officedocument.wordprocessingml.document",
      ];

      if (!allowed.includes(formData.cv.type)) {
        newErrors.cv = "Only PDF, DOC, or DOCX files are allowed";
      }
    }

    setErrors(newErrors);
    return Object.keys(newErrors).length === 0;
  };

  const handleSubmit = async (e) => {
    e.preventDefault();
    if (!validate()) return;

    const fd = new FormData();
    Object.keys(formData).forEach((key) => {
      fd.append(key, formData[key]);
    });

    try {
      let data = await axios.post(`${BASE_URL}/jobposts`, fd);
      if (data.data.status) {
        toast.success(data.data.message);
        setFormData({
          job_id: "",
          applicant_name: "",
          phone_number: "",
          email: "",
          description: "",
          cv: null,
        });
        // Clear the file input
        const fileInput = document.getElementById("pdf-cv");
        if (fileInput) fileInput.value = "";
        // Close the modal
        const closeButton = document.getElementById("close-id-job");
        if (closeButton) closeButton.click();
      } else {
        toast.error(data.data.message);
      }
    } catch (error) {
      console.log(error);
      toast.error("Something went wrong. Please try again.");
    }
  };

  // Handle Enter key on file input to submit form instead of reopening file dialog
  const handleFileInputKeyDown = (e) => {
    if (e.key === "Enter") {
      e.preventDefault(); // Prevent file dialog from reopening

      // Submit the form if valid
      if (validate()) {
        const form = e.target.closest("form");
        if (form) {
          const submitEvent = new Event("submit", {
            cancelable: true,
            bubbles: true,
          });
          form.dispatchEvent(submitEvent);
        }
      }
    }
  };
  const formclear = () => {
    setFormData({
      job_id: "",
      applicant_name: "",
      phone_number: "",
      email: "",
      description: "",
      cv: null,
    });
  };
  // Handle Enter key on the entire form for better UX
  const handleFormKeyPress = (e) => {
    // Allow Enter to submit form from any field except textareas and file inputs
    if (
      e.key === "Enter" &&
      e.target.tagName !== "TEXTAREA" &&
      e.target.type !== "file"
    ) {
      e.preventDefault();
      if (validate()) {
        handleSubmit(e);
      }
    }
  };

  return (
    <>
      {bannerData.image && <Banner data={bannerData} />}

      <div className="aplymesg">
        <div className="container">
          <div className="carearmeasg">
            <p>Apply From our website or app. login with your phone number.</p>
          </div>
        </div>
      </div>

      <div className="serviceSec">
        <div className="container">
          <div className="career-list row">
            {data.length === 0 ? (
              <div className="container mt-5">
                <div className="row justify-content-center">
                  <div className="col-md-6">
                    <div className="card text-center shadow-sm">
                      <div className="card-body">
                        <h4 className="card-title text-muted">
                          No Job Openings
                        </h4>
                        <p className="card-text">
                          We currently do not have any job openings. Please
                          check back later.
                        </p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            ) : (
              <>
                {data.map((job, index) => (
                  <div className="col-lg-4 col-md-6" key={index}>
                    <div className="career-item p-4">
                      <div className="career-info">
                        <h5>{job.title}</h5>
                        <p>
                          Location: <span>{job.location ?? "N/A"}</span>
                        </p>
                        <p>
                          Experience:{" "}
                          <span>
                            {job.min_experience} - {job.max_experience} years
                          </span>
                        </p>
                      </div>

                      <div className="career-description">
                        {/* <Markup content={job.description} /> */}
                        <p>
                          Salary: <span>₹20,000 - ₹25,000</span>
                        </p>
                      </div>

                      <button
                        className="btn btn-warning mt-3 text-white"
                        data-bs-toggle="modal"
                        data-bs-target="#applyModal"
                        onClick={() => openModal(job)}
                      >
                        Apply Now
                      </button>
                    </div>
                  </div>
                ))}
              </>
            )}
          </div>
        </div>
      </div>

      {/* Modal */}
      <div
        className="modal fade"
        id="applyModal"
        tabIndex="-1"
        aria-labelledby="applyModalLabel"
        aria-hidden="true"
      >
        <div className="modal-dialog modal-lg">
          <div className="modal-content">
            <div className="modal-header">
              <h5 className="modal-title" id="applyModalLabel">
                Apply for {selectedJob?.title}
              </h5>
              <button
                id="close-id-job"
                type="button"
                className="btn-close"
                data-bs-dismiss="modal"
                aria-label="Close"
                onClick={formclear}
              ></button>
            </div>

            <form onSubmit={handleSubmit} onKeyPress={handleFormKeyPress}>
              <div className="modal-body">
                <input type="hidden" name="job_id" value={formData.job_id} />

                <div className="mb-3">
                  <label htmlFor="applicant_name" className="form-label">
                    Name *
                  </label>
                  <input
                    type="text"
                    id="applicant_name"
                    name="applicant_name"
                    value={formData.applicant_name}
                    className={`form-control ${errors.applicant_name ? "is-invalid" : ""}`}
                    onChange={handleChange}
                    required
                  />
                  {errors.applicant_name && (
                    <div className="invalid-feedback">
                      {errors.applicant_name}
                    </div>
                  )}
                </div>

                <div className="mb-3">
                  <label htmlFor="phone_number" className="form-label">
                    Phone *
                  </label>
                  <input
                    type="tel"
                    id="phone_number"
                    name="phone_number"
                    value={formData.phone_number}
                    className={`form-control ${errors.phone_number ? "is-invalid" : ""}`}
                    onChange={handleChange}
                    required
                  />
                  {errors.phone_number && (
                    <div className="invalid-feedback">
                      {errors.phone_number}
                    </div>
                  )}
                </div>
                <div className="mb-3">
                  <label htmlFor="email" className="form-label">
                    Email *
                  </label>
                  <input
                    type="email"
                    id="email"
                    name="email"
                    value={formData.email}
                    className={`form-control ${errors.email ? "is-invalid" : ""}`}
                    onChange={handleChange}
                    required
                  />
                  {errors.email && (
                    <div className="invalid-feedback">{errors.email}</div>
                  )}
                </div>

                <div className="mb-3">
                  <label htmlFor="description" className="form-label">
                    Description (Optional)
                  </label>
                  <textarea
                    id="description"
                    name="description"
                    value={formData.description}
                    className={`form-control ${errors.description ? "is-invalid" : ""}`}
                    rows="3"
                    onChange={handleChange}
                  />
                  {errors.description && (
                    <div className="invalid-feedback">{errors.description}</div>
                  )}
                  <small className="text-muted">Maximum 500 characters</small>
                </div>

                <div className="mb-3">
                  <label htmlFor="pdf-cv" className="form-label">
                    Upload CV *
                  </label>

                  <div className="container-fluid">
                    <div className="row align-items-center">
                      {/* File Input */}
                      <div className="col-md-6">
                        <input
                          id="pdf-cv"
                          type="file"
                          accept="application/pdf"
                          name="cv"
                          className={`form-control ${errors.cv ? "is-invalid" : ""}`}
                          onChange={handleChange}
                          onKeyDown={handleFileInputKeyDown}
                        />
                        {errors.cv && (
                          <div className="invalid-feedback">{errors.cv}</div>
                        )}
                      </div>

                      {/* File Name Display */}
                      <div className="col-md-6">
                        {formData.cv && (
                          <div className="mt-2 text-truncate">
                            <strong>Selected file:</strong>{" "}
                            <span title={formData.cv.name}>
                              {formData.cv.name}
                            </span>
                          </div>
                        )}
                      </div>
                    </div>
                  </div>

                  {errors.cv && (
                    <div className="invalid-feedback">{errors.cv}</div>
                  )}

                  <small className="text-muted">Only PDF files, max 2MB</small>
                </div>
              </div>

              <div className="modal-footer">
                <button
                  type="button"
                  className="btn btn-secondary"
                  data-bs-dismiss="modal"
                  onClick={formclear}
                >
                  Close
                </button>

                <button
                  id="submit-application-btn"
                  type="submit"
                  className="btn btn-warning"
                >
                  Submit Application
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </>
  );
};

export default Career;
