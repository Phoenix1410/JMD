import React, { useEffect, useRef, useState } from "react";
import { Banner } from "../../partial/Component/Banner.jsx";
import { BASE_URL } from "../../../config.js";
import axios from "axios";
import TrackingForm from "./TrackingForm.jsx";
import ProgressSection from "./ProgressSection.jsx";
import { use } from "react";
import { useLocation, useSearchParams } from "react-router-dom";

const Tracking = () => {
  const location = useLocation();
  const [searchParams] = useSearchParams();
  const id = searchParams.get("id");
  const formRef = useRef(null);
  const progessRef = useRef(null);
  const [result, setResult] = useState(null);
  let [bannerData, setBannerData] = useState({});
  const [formData, setFormData] = useState({
    trackingId: "",
    phone: "",
  });

  let fetchBanner = async () => {
    try {
      await axios
        .post(`${BASE_URL}/banner`, { slug: "tracking" })
        .then((res) => {
          if (res.data.status === 1) {
            setBannerData(res.data.responseData.banner[0] ?? {});
          }
        });
    } catch (error) {
      console.log(error);
    }
  };
  const scrollToForm = () => {
    const element = formRef.current;
    const yOffset = -120; // 10px above
    const y =
      element.getBoundingClientRect().top + window.pageYOffset + yOffset;

    window.scrollTo({ top: y, behavior: "smooth" });
  };
  useEffect(() => {
    fetchBanner();
    // fetchData();
  }, []);
  useEffect(() => {
    id && setFormData({ ...formData, trackingId: id });
    id && scrollToForm();
  }, [id, bannerData]);
  return (
    <>
      {bannerData.image && <Banner data={bannerData} />}
      <TrackingForm
        setResult={setResult}
        progessRef={progessRef}
        formRef={formRef}
        formData={formData}
        setFormData={setFormData}
      />
      {result && (
        <ProgressSection
          result={result}
          progessRef={progessRef}
          setResult={setResult}
          setFormData={setFormData}
          formRef={formRef}
        />
      )}
    </>
  );
};

export default Tracking;
