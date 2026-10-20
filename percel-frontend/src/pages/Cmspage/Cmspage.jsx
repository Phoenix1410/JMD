import React, { useEffect, useState } from "react";
import { Banner } from "../../partial/Component/Banner.jsx";
import axios from "axios";
import { BASE_URL } from "../../../config.js";
import { Markup } from "interweave";
import { toast } from "react-toastify";

const Cmspage = () => {
  let [bannerData, setBannerData] = useState({});

  let [data, setData] = useState({});
  let [clientData, setClientData] = useState([]);
  let fetchBanner = async () => {
    try {
      await axios
        .post(`${BASE_URL}/banner`, { slug: "privacypolicy" })
        .then((res) => {
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
      const res = await axios.get(`${BASE_URL}/cms/privacy-policy`);
      console.log(res.data.responseData.cms);
      //   if (res.data.status === 1) {
      setData(res.data.responseData.cms); // ✅ FIXED
      //   }
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

  return (
    <>
      {bannerData.image && <Banner data={bannerData} />}
      <div className="presenceNewSec whoweSec privacypolicycntainer">
        <div className="container">
          <Markup content={data.page_content} />
        </div>
      </div>
    </>
  );
};

export default Cmspage;
