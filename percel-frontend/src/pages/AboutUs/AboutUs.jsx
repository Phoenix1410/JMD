import React, { useEffect, useState } from "react";
import { Banner } from "../../partial/Component/Banner.jsx";
import axios from "axios";
import { BASE_URL, BASE_IMAGE_URL } from "../../../config.js";

import { Markup } from "interweave";

const AboutUs = () => {
  let [bannerData, setBannerData] = useState({});

  let [data, setData] = useState({});
  let [clientData, setClientData] = useState([]);
  let fetchBanner = async () => {
    try {
      await axios.post(`${BASE_URL}/banner`, { slug: "about" }).then((res) => {
        if (res.data.status === 1) {
          setBannerData(res.data.responseData.banner[0] ?? {});
        }
      });
    } catch (error) {
      console.log(error);
    }
  };
  let fetchData = async () => {
    try {
      const res = await axios.get(`${BASE_URL}/about-us`);

      console.log(res.data);

      if (res.data.success) {
        setData(res.data.data); // ✅ FIXED
      }
    } catch (error) {
      console.log(error);
    }
  };
  let fetchClientData = async () => {
    try {
      await axios.get(`${BASE_URL}/clientlist`).then((res) => {
        if (res.data.status === 1) {
          setClientData(res.data.data);
        }
      });
    } catch (error) {
      console.log(error);
    }
  };

  useEffect(() => {
    fetchClientData();

    fetchBanner();
    fetchData();
  }, []);
  console.log(data);

  return (
    <>
      {bannerData.image && <Banner data={bannerData} />}
      <div className="presenceNewSec whoweSec">
        <div className="container">
          {/* <div className="aboutoneSec">
            <div class="presencehding txtcenter">
              <h2>Who We Are</h2>
              <p>SPS Paarcel Private Limited is a leading freight forwarding and logistics company providing transportation and freight forwarding services across India.</p>
              <p>Our organization operates its own fleet of trucks and offers reliable logistics services in thee. regions of Andhra Pradesh, Assam, Bihar, Chhattisgarh, Delhi, Gujarat, Haryana, Jharkhand, Madhya Pradesh, Maharasthara, Odisha, Punjab, Rajasthan, Tamil Nadu, Uttar Pradesh and West Bengal.</p>
            </div>
            <div className="abutepnel">
              <div className="media">
                <div className="abutemeimge">
                  <img src="https://developer-beta.com/p7/parrcell_backend/assets/admin/images/image43.png" alt="" />
                </div>
                <div className="media-object">
                  <p>Since its inception, PAARCEL has been committed to delivering full-truck load and parcel services through a strong fleet network and trained support staff.</p>
                </div>
              </div>
            </div>
          </div> */}
          {/* <div style={{ maxWidth: "900px", margin: "auto", lineHeight: "1.7" }}> */}
          <Markup content={data.content} />
          {/* </div> */}
          <div className="abtetwopnel">
            <div className="row">
              <div className="col-4">
                <div className="secviceCont">
                  <figure>
                    <img src={BASE_IMAGE_URL + data.fleet_icon} alt="" />
                  </figure>
                  <h3>{data.fleet_name}</h3>
                  <p>{data.fleet_content}</p>
                </div>
              </div>
              <div className="col-4">
                <div className="secviceCont">
                  <figure>
                    <img src={BASE_IMAGE_URL + data.network_icon} alt="" />
                  </figure>
                  <h3>{data.network_name}</h3>
                  <p>{data.network_content}</p>
                </div>
              </div>
              <div className="col-4">
                <div className="secviceCont">
                  <figure>
                    <img src={BASE_IMAGE_URL + data.delivery_icon} alt="" />
                  </figure>
                  <h3>{data.delivery_name}</h3>
                  <p>{data.delivery_content}</p>
                </div>
              </div>
            </div>
          </div>
          <div className="abtethrepnel">
            <div className="row">
              <div className="col-3">
                <div className="abtenmber">
                  <h3>{data.states_covered}+</h3>
                  <p>States Covered</p>
                </div>
              </div>
              <div className="col-3">
                <div className="abtenmber">
                  <h3>{data.branches}+</h3>
                  <p>Branches</p>
                </div>
              </div>
              <div className="col-3">
                <div className="abtenmber">
                  <h3>{data.daily_shipments}+</h3>
                  <p>Daily Shipments</p>
                </div>
              </div>
              <div className="col-3">
                <div className="abtenmber">
                  <h3>10+</h3>
                  <p>Years Experience</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </>
  );
};

export default AboutUs;
