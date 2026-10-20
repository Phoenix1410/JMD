import React, { useEffect } from "react";
import ContactSection from "./ContactSection";
import { shallowEqual, useSelector } from "react-redux";
import { Link, useNavigate } from "react-router-dom";
import ImageComponent from "./Component/ImageComponent";

import mailIcn_fter from "../assets/images/mailIcn_fter.png";
import callicn_fter from "../assets/images/callicn_fter.png";

import homeIcn from "../assets/images/homeIcn.png";
import serviceIcn from "../assets/images/serviceIcn.png";
import trakingIcn from "../assets/images/trakingIcn.png";

const Footer = () => {
  const navigate = useNavigate();

  const { siteData } = useSelector(
    (state) => ({
      siteData: state.data.siteData,
    }),
    shallowEqual,
  );

  // ✅ Contact scroll handler (works from any page)
  const handleContactClick = (e) => {
    e.preventDefault();

    navigate("/");

    setTimeout(() => {
      const section = document.getElementById("contact-section");
      if (section) {
        window.scrollTo({
          top: section.offsetTop - 100,
          behavior: "smooth",
        });
      }
    }, 300);
  };

  // ✅ Accordion logic (your existing jQuery)
  useEffect(() => {
    $(document).ready(function () {
      function initAccordion() {
        if ($(window).width() <= 767) {
          $(".ftrtitle")
            .off("click")
            .on("click", function () {
              var parent = $(this).parent();

              $(".ftracdianItem")
                .not(parent)
                .removeClass("active")
                .find(".fterconte")
                .slideUp();

              parent.toggleClass("active");
              parent.find(".fterconte").slideToggle();
            });
        } else {
          $(".fterconte").show();
          $(".ftracdianItem").removeClass("active");
          $(".ftrtitle").off("click");
        }
      }

      initAccordion();

      $(window).resize(function () {
        initAccordion();
      });
    });
  }, []);

  return (
    <>
      <ContactSection />

      {/* Mobile Footer */}
      <div className="foterMobile">
        <ul>
          <li>
            <Link to="/">
              <i>
                <img src={homeIcn} alt="" />
              </i>{" "}
              Home
            </Link>
          </li>
          <li>
            <Link to="/services">
              <i>
                <img src={serviceIcn} alt="" />
              </i>{" "}
              Services
            </Link>
          </li>
          <li>
            <Link to="/tracking">
              <i>
                <img src={trakingIcn} alt="" />
              </i>{" "}
              Tracking
            </Link>
          </li>
        </ul>
      </div>

      <section className="dark-info-section">
        <div className="container-fluid">
          <div className="row g-0 align-items-stretch">
            {/* Logo */}
            <div className="col-lg-4 d-flex align-items-center justify-content-center logo-panel">
              <Link to={"/"}>
                <ImageComponent
                  src={siteData.footerLogo}
                  alt="Parrcell"
                  className="img-fluid company-logo"
                />
              </Link>
            </div>

            {/* Right Section */}
            <div className="col-lg-8 px-4 px-lg-5 text-light mobilfter py-5">
              <div className="foterright">
                <div className="fteracdian">
                  {/* Quick Links */}
                  <div className="ftracdianItem active">
                    <div className="ftrtitle">
                      <h3>Ouick Links:</h3>
                    </div>

                    <div className="fterconte" style={{ display: "block" }}>
                      <div className="ftrlink">
                        <ul>
                          <li>
                            <Link to="/about">About Us</Link>
                          </li>
                          <li>
                            <Link to="/network">Network</Link>
                          </li>
                          <li>
                            <Link to="/career">Career</Link>
                          </li>
                          <li>
                            <Link to="/privacy-policy">Privacy Policy</Link>
                          </li>

                          {/* ✅ Fixed Contact */}
                          {/* <li>
                            <Link
                              onClick={(e) => {
                                setMenuOpen(false);
                                scrollToContact(e);
                              }}
                            >
                              Contact
                            </Link>
                          </li> */}
                        </ul>
                      </div>
                    </div>
                  </div>

                  {/* Locations */}
                  <div className="ftracdianItem">
                    <div className="ftrtitle">
                      <h3>Locations:</h3>
                    </div>

                    <div className="fterconte">
                      <div className="row">
                        {siteData?.footercontent?.map((item) => (
                          <div className="col-md-6 mb-4" key={item.id}>
                            <h4>{item.title}:</h4>
                            <p>{item.address}</p>
                          </div>
                        ))}
                      </div>
                    </div>
                  </div>
                </div>

                {/* Contact Info */}
                <div className="ftrinfo">
                  <h3>Contact Us</h3>

                  <p className="mt-4">
                    <span>
                      <i>
                        <img src={callicn_fter} alt="" />
                      </i>
                      <a
                        style={{ color: "#f8f9fa" }}
                        href={`tel:${siteData.phonenumber}`}
                      >
                        +91-{siteData.phonenumber}
                      </a>

                      {" | "}

                      <a
                        style={{ color: "#f8f9fa" }}
                        href={`tel:+91${siteData.additionalphonenumber}`}
                      >
                        +91-{siteData.additionalphonenumber}
                      </a>
                    </span>

                    <span>
                      <i>
                        <img src={mailIcn_fter} alt="" />
                      </i>
                      <a
                        style={{ color: "#f8f9fa" }}
                        href={`mailto:${siteData.email}`}
                      >
                        {siteData.email}
                      </a>
                    </span>
                  </p>
                </div>
              </div>
            </div>
          </div>

          {/* Bottom Bar */}
          <div className="row align-items-center py-3 border-top social-bar">
            <div className="col-md-4 text-center">
              <div className="ftersocil">
                {siteData.facebook && (
                  <a
                    target="_blank"
                    rel="noreferrer"
                    href={siteData.facebook}
                    className="social-icon me-3"
                  >
                    <i className="fa-brands fa-facebook-f"></i>
                  </a>
                )}

                {siteData.linkedin && (
                  <a
                    target="_blank"
                    rel="noreferrer"
                    href={siteData.linkedin}
                    className="social-icon me-3"
                  >
                    <i className="fa-brands fa-linkedin-in"></i>
                  </a>
                )}

                {siteData.twitter && (
                  <a
                    target="_blank"
                    rel="noreferrer"
                    href={siteData.twitter}
                    className="social-icon me-3"
                  >
                    <i className="fa-brands fa-x"></i>
                  </a>
                )}

                {siteData.instagram && (
                  <a
                    target="_blank"
                    rel="noreferrer"
                    href={siteData.instagram}
                    className="social-icon me-3"
                  >
                    <i className="fa-brands fa-instagram"></i>
                  </a>
                )}
                {siteData.youtube && (
                  <a
                    target="_blank"
                    rel="noreferrer"
                    href={siteData.youtube}
                    className="social-icon"
                  >
                    <i className="fa-brands fa-youtube"></i>
                  </a>
                )}
              </div>
            </div>

            <div className="col-md-4 text-white copright px-lg-5">
              <p>
                {" "}
                © {new Date().getFullYear()} {siteData.siteName} All Rights
                Reserved
              </p>
            </div>

            <div className="col-md-4 text-white copright px-lg-5">
              <p>{siteData.companyName}</p>
            </div>
          </div>
        </div>
      </section>
    </>
  );
};

export default Footer;
