import React, { useEffect, useRef, useState } from "react";
import { useNavigate } from "react-router-dom";
import serchicn from "../../assets/images/serchicn.svg";
import { BASE_IMAGE_URL, BASE_URL } from "../../../config";
import GoogleTranslate from "../../GoogleTranslate";
import { toast } from "react-toastify";
import bxs_map from "../../assets/images/bxs_map.svg";
const TrackingSection = ({ data }) => {
  const [trackingId, setTrackingId] = useState("");
  const [error, setError] = useState(false);
  const navigate = useNavigate();
  const [branchQuery, setBranchQuery] = useState("");
  const [branchSuggestions, setBranchSuggestions] = useState([]);
  const [showSuggestions, setShowSuggestions] = useState(false);
  const [branchLoading, setBranchLoading] = useState(false);
  const debounceRef = useRef(null);
  const desktopWrapperRef = useRef(null);
  const mobileWrapperRef = useRef(null);
  const fetchBranchSuggestions = async (query) => {
    if (!query || query.trim().length < 2) {
      setBranchSuggestions([]);
      return;
    }

    try {
      setBranchLoading(true);

      const res = await fetch(
        `${BASE_URL}/get-branches?search=${encodeURIComponent(query.trim())}`,
      );
      const result = await res.json();

      // Real API shape:
      // { status: 1, responseText: "Branches Fetch Successful",
      //   responseData: { branches: [{ id, name, google_link, state_name }] } }
      console.log("result", result);

      if (result?.status !== 1) {
        console.error("Branch locator API error:", result?.responseText);
        setBranchSuggestions([]);
        setShowSuggestions(true);
        return;
      }

      const branches = result?.responseData?.branches || [];

      // Normalize to the { id, name, address, google_link } shape the dropdown expects
      const normalized = branches.map((b) => ({
        id: b.id,
        name: b.name,
        address: b.address,
        state_name: b.state_name,
        contact_person: b.contact_person,
        phone: b.phone,
        google_link: b.google_link,
      }));

      setBranchSuggestions(normalized);
      setShowSuggestions(true);
    } catch (err) {
      console.error("Branch locator API error:", err);
      setBranchSuggestions([]);
    } finally {
      setBranchLoading(false);
    }
  };

  const handleBranchChange = (e) => {
    const value = e.target.value;
    setBranchQuery(value);

    if (debounceRef.current) clearTimeout(debounceRef.current);
    debounceRef.current = setTimeout(() => {
      fetchBranchSuggestions(value);
    }, 300);
  };

  const handleSelectBranch = (branch) => {
    if (!branch) return;

    setBranchQuery(branch.name || "");
    setShowSuggestions(false);
    setBranchSuggestions([]);

    if (branch?.google_link) {
      let url = branch.google_link;

      if (!url.startsWith("http://") && !url.startsWith("https://")) {
        url = "https://" + url;
      }

      window.open(url, "_blank", "noopener,noreferrer");

      setTimeout(() => {
        setBranchQuery("");
      }, 300);
    } else {
      toast.error("Branch link not available. Please try another branch.");
    }
  };

  useEffect(() => {
    const handleClickOutside = (event) => {
      const clickedInsideDesktop =
        desktopWrapperRef.current &&
        desktopWrapperRef.current.contains(event.target);

      const clickedInsideMobile =
        mobileWrapperRef.current &&
        mobileWrapperRef.current.contains(event.target);

      if (!clickedInsideDesktop && !clickedInsideMobile) {
        setShowSuggestions(false);
      }
    };

    document.addEventListener("mousedown", handleClickOutside);

    return () => {
      document.removeEventListener("mousedown", handleClickOutside);
    };
  }, []);

  const banner = data?.[0]; // ✅ direct usage

  const trackingSubmit = (e) => {
    e.preventDefault();

    if (trackingId) {
      navigate("/tracking?id=" + trackingId);
    } else {
      setError(true);
    }
  };

  return (
    <div className="shipmentSec">
      <div className="shipmentimge">
        <img src={BASE_IMAGE_URL + banner?.image} alt="" />

        <div className="shipmenttext">
          <div className="container">
            <div className="row gx-lg-5 justify-content-between">
              <div className="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                {/* <div className="col-12">
                <div className="hedingshipment">
                  <h1>{banner.title}</h1>
                </div>
              </div> */}
                <div
                  className="shipmentfrmpnl d-none d-md-block branchLocatorPnl"
                  ref={desktopWrapperRef}
                  style={{ position: "relative", marginTop: "16px" }}
                >
                  <input
                    type="text"
                    placeholder="Branch Locator "
                    value={branchQuery}
                    onChange={handleBranchChange}
                    onFocus={() => {
                      if (branchSuggestions.length > 0)
                        setShowSuggestions(true);
                    }}
                    autoComplete="off"
                  />

                  {showSuggestions && (
                    <ul className="branchSuggestionList">
                      {branchLoading && (
                        <li className="branchSuggestionLoading">
                          Searching...
                        </li>
                      )}

                      {!branchLoading &&
                        branchSuggestions.length === 0 &&
                        branchQuery.trim().length >= 2 && (
                          <li className="branchSuggestionEmpty">
                            No branches found
                          </li>
                        )}

                      {!branchLoading &&
                        branchSuggestions.map((branch) => (
                          <li key={branch.id} className="branchSuggestionItem">
                            <div className="flex-fill">
                              <strong>{branch.name}</strong>
                              {branch.address && (
                                <p>
                                  <strong>Address: </strong>
                                  <span>{branch.address}</span>
                                </p>
                              )}

                              {branch.contact_person && (
                                <p>
                                  <strong>Contact: </strong>
                                  <span>{branch.contact_person}</span>
                                </p>
                              )}

                              {branch.phone && (
                                <p>
                                  <strong>Phone: </strong>
                                  <span>{branch.phone}</span>
                                </p>
                              )}
                            </div>
                            <div className="align-self-start">
                              <button onClick={() => handleSelectBranch(branch)}>
                                <img src={bxs_map} alt="" /> View On Map
                              </button>
                            </div>
                          </li>
                        ))}
                    </ul>
                  )}
                </div>
                <div className="shipmentfrm">
                  <div
                    className="shipmentfrmpnl d-md-none branchLocatorPnl mb-3"
                    ref={mobileWrapperRef}
                    style={{ position: "relative" }}
                  >
                    <input
                      type="text"
                      placeholder="Branch Locator"
                      value={branchQuery}
                      onChange={handleBranchChange}
                      onFocus={() => {
                        if (branchSuggestions.length > 0)
                          setShowSuggestions(true);
                      }}
                      autoComplete="off"
                    />

                    {showSuggestions && (
                      <ul className="branchSuggestionList">
                        {branchLoading && (
                          <li className="branchSuggestionLoading">
                            Searching...
                          </li>
                        )}

                        {!branchLoading &&
                          branchSuggestions.length === 0 &&
                          branchQuery.trim().length >= 2 && (
                            <li className="branchSuggestionEmpty">
                              No branches found
                            </li>
                          )}

                        {!branchLoading &&
                          branchSuggestions.map((branch) => (
                            <li
                              key={branch.id}
                              className="branchSuggestionItem"
                            >
                              <div className="flex-fill">
                                <strong>{branch.name}</strong>
                                {branch.address && (
                                  <p>
                                    <strong>Address: </strong>
                                    <span>{branch.address}</span>
                                  </p>
                                )}

                                {branch.contact_person && (
                                  <p>
                                    <strong>Contact: </strong>
                                    <span>{branch.contact_person}</span>
                                  </p>
                                )}

                                {branch.phone && (
                                  <p>
                                    <strong>Phone: </strong>
                                    <span>{branch.phone}</span>
                                  </p>
                                )}
                              </div>
                              <div className="align-self-start">
                                <button
                                  onClick={() => handleSelectBranch(branch)}
                                >
                                  <img src={bxs_map} alt="" /> View On Map
                                </button>
                              </div>
                            </li>
                          ))}
                      </ul>
                    )}
                  </div>
                  <div className="shipmentfrmtitle">
                    <h2>{banner.title}</h2>
                    <p>{banner.short_description}</p>
                  </div>

                  <div className="shipmentfrmpnl">
                    <input
                      type="tel"
                      placeholder="Enter LR Number"
                      value={trackingId}
                      onChange={(e) => {
                        if (!/^\d*$/.test(e.target.value)) return;
                        setTrackingId(e.target.value);
                        setError(false);
                      }}
                    />

                    <button onClick={trackingSubmit}>
                      <i>
                        <img src={serchicn} alt="" />
                      </i>{" "}
                      Track Shipment
                    </button>
                  </div>

                  {error && (
                    <small style={{ color: "red" }}>
                      Tracking ID is required
                    </small>
                  )}
                </div>
              </div>
              <div className="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 align-self-center">
                <div className="languagebx ms-lg-5">
                  <div className="languagetoptext">
                    <div className="languagetopicon">
                      <svg
                        viewBox="2 2 20 20"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                      >
                        <path
                          d="M21 12C21 16.9706 16.9706 21 12 21C7.02944 21 3 16.9706 3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12Z"
                          stroke="currentColor"
                          stroke-width="1"
                        />
                        <path
                          d="M16 12C16 16.9706 14.2091 21 12 21C9.79086 21 8 16.9706 8 12C8 7.02944 9.79086 3 12 3C14.2091 3 16 7.02944 16 12Z"
                          stroke="currentColor"
                          stroke-width="1"
                        />
                        <path
                          d="M20 16.795C18.2145 15.7053 15.3666 15 12.1583 15C8.75309 15 5.75391 15.7945 4 17"
                          stroke="currentColor"
                          stroke-width="1"
                        />
                        <path
                          d="M20 7.08688C18.2506 8.24353 15.3484 9 12.0641 9C8.69818 9 5.73365 8.2055 4 7"
                          stroke="currentColor"
                          stroke-width="1"
                        />
                      </svg>
                    </div>
                    <div className="languagetoptextright">
                      <h3>Select Your Language / अपनी भाषा चुनें</h3>
                      <p>
                        Choose your preferred language / अपनी पसंदीदा भाषा चुनें
                      </p>
                    </div>
                  </div>
                  <GoogleTranslate />
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
};

export default TrackingSection;
