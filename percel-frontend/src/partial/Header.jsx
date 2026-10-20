import React, { useEffect, useRef, useState } from "react";
import logo from "../assets/images/logo.png";
import search from "../assets/images/search-interface-symbol.png";
import mailicn from "../assets/images/mailicn.png";
import callicn from "../assets/images/callicn.png";
import playstoreicn from "../assets/images/playstoreicon.png";
import applestore from "../assets/images/appleplaystore.png";
import { Link, NavLink, useLocation, useNavigate } from "react-router-dom";
import { shallowEqual, useSelector } from "react-redux";
import { BASE_IMAGE_URL } from "../../config";
import InfoScroller from "./InfoScroller";
import ImageComponent from "./Component/ImageComponent";
import { useScreenSize } from "../useScreenSize"; // Import the hook
import whatsappIcn from "../assets/images/whatsappIcn.png";
import chatIcn from "../assets/images/chatIcn.png";

const menuItems = [
  { path: "/", label: "HOME", end: true },
  { path: "/services", label: "SERVICES" },
  { path: "/about", label: "ABOUT US" },
  { path: "/network", label: "NETWORK" },
  { path: "/tracking", label: "TRACKING" },
  { path: "/career", label: "CAREER" },
];

const Header = () => {
  let [trackingId, setTrackingId] = useState("");
  let [error, setError] = useState(false);
  const { siteData } = useSelector(
    (state) => ({
      siteData: state.data.siteData,
    }),
    shallowEqual,
  );
  const headerRef = useRef(null);
  const location = useLocation();
  let navigate = useNavigate();
  const [isFixed, setIsFixed] = useState(false);
  const [searchOpen, setSearchOpen] = useState(false);
  const [menuOpen, setMenuOpen] = useState(false);
  const [chatOpen, setChatOpen] = useState(false);
  const [chatLanguage, setChatLanguage] = useState("");
  const [chatStep, setChatStep] = useState("language");
  const [chatMessages, setChatMessages] = useState([]);
  const [chatInput, setChatInput] = useState("");

  // Use the screen size hook
  const { isMobile } = useScreenSize();

  const scrollToContact = (e) => {
    e.preventDefault();
    const section = document.getElementById("contact-section");
    const offset = isFixed ? 100 : 200;

    if (section) {
      const top =
        section.getBoundingClientRect().top + window.pageYOffset - offset;

      window.scrollTo({
        top: top,
        behavior: "smooth",
      });
    }
  };

  // Sticky header scroll
  useEffect(() => {
    const handleScroll = () => {
      if (!headerRef.current) return;

      const scrollTop = window.scrollY;
      const headerHeight = headerRef.current.offsetHeight;

      setIsFixed(scrollTop > headerHeight);
    };

    window.addEventListener("scroll", handleScroll);

    return () => window.removeEventListener("scroll", handleScroll);
  }, []);

  let trackingSubmit = (e) => {
    e.preventDefault();
    trackingId ? navigate("/tracking?id=" + trackingId) : setError(true);
    setSearchOpen(false);
  };

  // Close search popup on background click
  const handlePopupClick = (e) => {
    if (e.target.classList.contains("search-popup")) {
      setSearchOpen(false);
    }
  };

  useEffect(() => {
    setError(false);
    if (location.pathname !== "/tracking") {
      setTrackingId("");
    }
  }, [location.pathname]);

  const resetChat = () => {
    setChatOpen(false);
    setChatLanguage("");
    setChatStep("language");
    setChatMessages([]);
    setChatInput("");
  };

  const addChatMessage = (sender, text) => {
    setChatMessages((prev) => [...prev, { sender, text }]);
  };

  const handleLanguageSelect = (lang) => {
    setChatLanguage(lang);
    addChatMessage(
      "bot",
      lang === "hi" ? "मैं आपकी कैसे मदद कर सकता हूँ" : "How can I help you?",
    );
    setChatStep("menu");
  };

  const handleMenuSelect = (option) => {
    if (option === "track") {
      addChatMessage(
        "bot",
        chatLanguage === "hi"
          ? "अपना ट्रैकिंग आईडी दर्ज करें।"
          : "Please enter your tracking ID.",
      );
      setChatStep("awaitTracking");
    } else if (option === "branch") {
      addChatMessage(
        "bot",
        chatLanguage === "hi"
          ? "ब्रांच नाम दर्ज करें।"
          : "Please enter the branch name.",
      );
      setChatStep("awaitBranch");
    } else {
      addChatMessage(
        "bot",
        chatLanguage === "hi"
          ? "हमारे ग्राहक सहायता प्रतिनिधि जल्द ही आपसे संपर्क करेंगे।"
          : "Our customer support executive will contact you at the earliest.",
      );
      addChatMessage(
        "bot",
        chatLanguage === "hi"
          ? "Paarcel3u से बात करने के लिए धन्यवाद! हमें खुशी है कि हम आपकी मदद कर सके। यदि आपको बाद में अपने पैकेज के संबंध में और किसी सहायता की आवश्यकता हो, तो आप हमें कभी भी संदेश भेज सकते हैं। आपका दिन शुभ हो!"
          : "Thanks for talking to Paarcel3u! Glad we could help you today. If you need any more help with your package later, just send us a message anytime! Have a great day!",
      );
      setChatStep("completed");
    }
  };

  const handleChatSend = (e) => {
    e.preventDefault();
    const value = chatInput.trim();

    if (!value) return;

    addChatMessage("user", value);

    if (chatStep === "awaitTracking") {
      const trackingReply =
        chatLanguage === "hi"
          ? `नमस्कार! Paarcel3u से संपर्क करने के लिए धन्यवाद।\nआपके पार्सल की वर्तमान स्थिति इस प्रकार है:\n• फोन नंबर: 1234567890\n• वर्तमान स्थिति: [स्थिति डालें]\n• अनुमानित डिलीवरी: [दिनांक/समय डालें]\n• Google Maps लिंक: [संबंधित शाखा लिंक]\nशुभकामनाएं,\nPaarcel3u टीम`
          : `Hi! Thank you for reaching out to Paarcel3u.\nHere is the current status of your Paarcel:\n• Phone number: 1234567890\n• Current Status: [Insert Status]\n• Estimated Delivery: [Insert Date/Time]\n• Google Maps link: [Branch link]\nBest regards,\nTeam Paarcel3u`;

      addChatMessage("bot", trackingReply);
      addChatMessage(
        "bot",
        chatLanguage === "hi"
          ? "Paarcel3u से बात करने के लिए धन्यवाद! हमें खुशी है कि हम आपकी मदद कर सके। यदि आपको बाद में अपने पैकेज के संबंध में और किसी सहायता की आवश्यकता हो, तो आप हमें कभी भी संदेश भेज सकते हैं। आपका दिन शुभ हो!"
          : "Thanks for talking to Paarcel3u! Glad we could help you today. If you need any more help with your package later, just send us a message anytime! Have a great day!",
      );
      setChatStep("completed");
    } else if (chatStep === "awaitBranch") {
      const branchName = value.toLowerCase();
      const branchDetails =
        branchName.includes("purnia") || branchName.includes("पूर्णिया")
          ? {
              address:
                chatLanguage === "hi"
                  ? "पूर्णिया शाखा, मुख्य बाजार के पास, पूर्णिया"
                  : "Purnia Branch, Near Main Market, Purnia",
              phone:
                chatLanguage === "hi" ? "+91 9876543210" : "+91 9876543210",
              map: "https://maps.google.com/?q=Purnia+Branch",
            }
          : {
              address:
                chatLanguage === "hi"
                  ? "शाखा का पता जल्द साझा किया जाएगा।"
                  : "Branch address will be shared shortly.",
              phone:
                chatLanguage === "hi"
                  ? "कृपया हमसे संपर्क करें।"
                  : "Please contact us for details.",
              map: "https://paarcel3u.in/",
            };

      addChatMessage(
        "bot",
        chatLanguage === "hi"
          ? `यहाँ ${branchName.includes("purnia") || branchName.includes("पूर्णिया") ? "पूर्णिया" : "आपकी"} शाखा की जानकारी दी गई है:\n• पता: ${branchDetails.address}\n• संपर्क विवरण: ${branchDetails.phone}\n• Google Maps: ${branchDetails.map}`
          : `Here are the branch details you requested:\n• Address: ${branchDetails.address}\n• Contact details: ${branchDetails.phone}\n• Google Maps: ${branchDetails.map}`,
      );
      addChatMessage(
        "bot",
        chatLanguage === "hi"
          ? "Paarcel3u से बात करने के लिए धन्यवाद! हमें खुशी है कि हम आपकी मदद कर सके। यदि आपको बाद में अपने पैकेज के संबंध में और किसी सहायता की आवश्यकता हो, तो आप हमें कभी भी संदेश भेज सकते हैं। आपका दिन शुभ हो!"
          : "Thanks for talking to Paarcel3u! Glad we could help you today. If you need any more help with your package later, just send us a message anytime! Have a great day!",
      );
      setChatStep("completed");
    } else if (chatStep === "awaitQuery") {
      addChatMessage(
        "bot",
        chatLanguage === "hi"
          ? "Paarcel3u से संपर्क करने के लिए धन्यवाद। हमारे ग्राहक सहायता प्रतिनिधि जल्द ही आपसे संपर्क करेंगे। आपका दिन मंगलमय हो!"
          : "Thank you for contacting Paarcel3u. Our customer support executive will contact you at the earliest. Wishing you a great day ahead!",
      );
      addChatMessage(
        "bot",
        chatLanguage === "hi"
          ? "Paarcel3u से बात करने के लिए धन्यवाद! हमें खुशी है कि हम आपकी मदद कर सके। यदि आपको बाद में अपने पैकेज के संबंध में और किसी सहायता की आवश्यकता हो, तो आप हमें कभी भी संदेश भेज सकते हैं। आपका दिन शुभ हो!"
          : "Thanks for talking to Paarcel3u! Glad we could help you today. If you need any more help with your package later, just send us a message anytime! Have a great day!",
      );
      setChatStep("completed");
    }

    setChatInput("");
  };

  return (
    <>
      <div className="fixedinfo">
        <ul>
          <li className="d-none d-md-block">
            <a href={`tel:${siteData.applestorelink}`}>
              <img src={applestore} alt="Apple Play Store" />
            </a>
          </li>
          <li>
            <a href={`tel:${siteData.playstorelink}`}>
              <img src={playstoreicn} alt="Google Play Store" />
            </a>
          </li>

          <li className="d-md-none fix-mb-10">
            <a href={`tel:${siteData.applestorelink}`}>
              <img src={applestore} alt="Apple Play Store" />
            </a>
          </li>
          <li>
            <a href={`tel:${siteData.phonenumber}`}>
              <img src={callicn} alt="call icon" />
            </a>
          </li>
          <li>
            <a href={`mailto:${siteData.email}`}>
              <img src={mailicn} alt="mail icon" />
            </a>
          </li>
          <li>
            <a
              target="_blank"
              href={`https://wa.me/91${siteData.additionalphonenumber}`}
            >
              <img src={whatsappIcn} alt="whatsapp icon" />
            </a>
          </li>
        </ul>
        {/* <li>
          <button
            type="button"
            className="chat-trigger-btn"
            onClick={() => setChatOpen(true)}
            aria-label="Open chat support"
          >
            <img src={chatIcn} alt="chat icon" />
          </button>
        </li> */}
      </div>
      {chatOpen && (
        <div className="chatbot-overlay" onClick={resetChat}>
          <div className="chatbot-panel" onClick={(e) => e.stopPropagation()}>
            <div className="chatbot-header">
              <div>
                <h4>Paarcel3u Assistant</h4>
                <p>
                  {chatStep === "language"
                    ? chatLanguage === "hi"
                      ? "भाषा चुनें"
                      : "Select your language"
                    : chatLanguage === "hi"
                      ? "हम आपकी मदद कर रहे हैं"
                      : "We are here to help you"}
                </p>
              </div>
              <button
                type="button"
                className="chatbot-close"
                onClick={resetChat}
              >
                ×
              </button>
            </div>

            <div className="chatbot-body">
              {chatStep === "language" && (
                <div className="chatbot-empty-state">
                  <p className="chatbot-intro">
                    {chatLanguage === "hi"
                      ? "भाषा चुनें"
                      : "Select your language"}
                  </p>
                  <div className="chatbot-options">
                    <button
                      type="button"
                      className="chatbot-option"
                      onClick={() => handleLanguageSelect("hi")}
                    >
                      हिंदी
                    </button>
                    <button
                      type="button"
                      className="chatbot-option"
                      onClick={() => handleLanguageSelect("en")}
                    >
                      English
                    </button>
                  </div>
                </div>
              )}

              {chatMessages.map((message, index) => (
                <div
                  key={`${message.sender}-${index}`}
                  className={`chatbot-message ${message.sender === "user" ? "user" : "bot"}`}
                >
                  {message.text}
                </div>
              ))}

              {chatStep === "menu" && (
                <div className="chatbot-menu">
                  <p className="chatbot-menu-title">
                    {chatLanguage === "hi"
                      ? "मैं आपकी कैसे मदद कर सकता हूँ"
                      : "How can I help you?"}
                  </p>
                  <div className="chatbot-options">
                    <button
                      type="button"
                      className="chatbot-option"
                      onClick={() => handleMenuSelect("track")}
                    >
                      {chatLanguage === "hi"
                        ? "अपने पार्सल को ट्रैक करें"
                        : "Track your Paarcel"}
                    </button>
                    <button
                      type="button"
                      className="chatbot-option"
                      onClick={() => handleMenuSelect("branch")}
                    >
                      {chatLanguage === "hi"
                        ? "ब्रांच डिटेल्स"
                        : "Branch details"}
                    </button>
                    <button
                      type="button"
                      className="chatbot-option"
                      onClick={() => handleMenuSelect("query")}
                    >
                      {chatLanguage === "hi"
                        ? "हमें अपने प्रश्न के बारे में बताएं"
                        : "Tell us about your query"}
                    </button>
                  </div>
                </div>
              )}
            </div>

            {chatStep === "awaitTracking" ||
            chatStep === "awaitBranch" ||
            chatStep === "awaitQuery" ? (
              <form className="chatbot-input-row" onSubmit={handleChatSend}>
                <input
                  type="text"
                  value={chatInput}
                  onChange={(e) => setChatInput(e.target.value)}
                  placeholder={
                    chatLanguage === "hi"
                      ? "अपना संदेश लिखें"
                      : "Type your message"
                  }
                />
                <button type="submit">
                  {chatLanguage === "hi" ? "भेजें" : "Send"}
                </button>
              </form>
            ) : null}
          </div>
        </div>
      )}

      <header
        ref={headerRef}
        className={`header ${isFixed ? "fixed_header" : ""} ${menuOpen ? "sideMenu" : ""}`}
      >
        <div class="menuOvrly"></div>
        <a
          onClick={(e) => {
            setMenuOpen(!menuOpen);
          }}
          href="javascript:void(0)"
          class="closeMenu"
        ></a>
        <div className="container">
          <div className="row align-items-center">
            <div className="col-lg-2 col-6">
              <div className="logo">
                <Link to={"/"}>
                  {siteData.sitbrandimage && (
                    <ImageComponent src={siteData.sitbrandimage} alt="" />
                  )}
                </Link>
              </div>
            </div>

            {/* Mobile Section */}
            <div className="col-6 d-lg-none d-flex gap-1 justify-content-end text-end">
              <button
                className="btn menu-toggle"
                onClick={() => setMenuOpen(!menuOpen)}
              >
                ☰
              </button>
            </div>

            <div className="col-lg-10">
              <div className="right_item ">
                <div className="menu">
                  <ul className="slimmenu">
                    {menuItems.map((item) => (
                      <li key={item.path}>
                        <NavLink
                          onClick={() => setMenuOpen(false)}
                          to={item.path}
                          end={item.end}
                          className={({ isActive }) =>
                            isActive ? "active current-menu-item" : ""
                          }
                        >
                          {item.label}
                        </NavLink>
                      </li>
                    ))}
                    <li>
                      <NavLink
                        onClick={(e) => {
                          setMenuOpen(false);
                          scrollToContact(e);
                        }}
                        to={"/"}
                      >
                        Contact
                      </NavLink>
                    </li>
                  </ul>
                </div>

                <div className="search_right">
                  <form>
                    <input
                      value={trackingId}
                      onChange={(e) => {
                        if (!/^\d*$/.test(e.target.value)) return;
                        setTrackingId(e.target.value);
                        setError(false);
                      }}
                      type="text"
                      className="form-control"
                      placeholder="Enter your tracking number"
                    />
                    <button
                      onClick={trackingSubmit}
                      type="submit"
                      className="btn btn-primary"
                    >
                      Track Order
                    </button>
                  </form>
                  {error && (
                    <small style={{ color: "red" }}>
                      Tracking ID is required
                    </small>
                  )}
                </div>

                <button
                  onClick={() => setSearchOpen(true)}
                  id="searchBtn"
                  className="btn"
                >
                  <img src={search} alt="" />
                </button>

                {searchOpen && (
                  <>
                    <div
                      className="search-popup active"
                      onClick={handlePopupClick}
                    >
                      <div className="search-box">
                        <button
                          onClick={() => setSearchOpen(false)}
                          className="close-btn"
                          id="closeSearch"
                        >
                          ×
                        </button>
                        <input
                          value={trackingId}
                          onChange={(e) => {
                            if (!/^\d*$/.test(e.target.value)) return;
                            setTrackingId(e.target.value);
                            setError(false);
                          }}
                          type="text"
                          placeholder="Enter your tracking number..."
                        />
                        {error && (
                          <small style={{ color: "red" }}>
                            Tracking ID is required
                          </small>
                        )}
                        <div className="button_design text-center">
                          <a
                            onClick={trackingSubmit}
                            href="#"
                            className="text-right mt-2"
                          >
                            Track Order
                          </a>
                        </div>
                      </div>
                    </div>
                  </>
                )}
              </div>
            </div>
          </div>
        </div>
      </header>
      <InfoScroller />
    </>
  );
};

export default Header;
