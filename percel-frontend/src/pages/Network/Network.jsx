import axios from "axios";
import React, { useEffect, useState } from "react";
import { Banner } from "./Banner";
import { BASE_URL, BASE_IMAGE_URL } from "../../../config";
import { Link } from "react-router-dom";
import IndiaMap from "../../partial/Map/IndiaMap";

const Network = () => {
  let [bannerData, setBannerData] = useState({});
  let [locationbannerData, setlocationBannerData] = useState({});
  let [data, setData] = useState([]);
  const fetchlocationBanner = async () => {
    try {
      const res = await axios.post(`${BASE_URL}/banner`, {
        slug: "location",
      });
      if (res.data.status === 1) {
        setlocationBannerData(res.data.responseData.banner[0] ?? {});
      }
    } catch (error) {
      console.log(error);
    }
  };
  let fetchBanner = async () => {
    try {
      await axios
        .post(`${BASE_URL}/banner`, { slug: "network" })
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
      const res = await axios.get(`${BASE_URL}/states`);

      if (res.data.status === 1) {
        setData(res.data.responseData.states); // should be array
      }
    } catch (error) {
      console.log(error);
    }
  };
  useEffect(() => {
    fetchBanner();
    fetchlocationBanner();
    fetchData();
  }, []);
  return (
    <>
      {bannerData.image && <Banner data={bannerData} />}
      <div className="presenceNewSec whoweSec">
        <div className="container">
          <div class="presencehding txtcenter">
            <h2>Where We Are</h2>
            <p>{locationbannerData.short_description}</p>
          </div>
          <div className="presence_map">
            {/* <img src={BASE_IMAGE_URL+locationbannerData.image} alt="" /> */}
            <IndiaMap data={data} />
          </div>
          <div className="locationpnel">
            <div className="row">
              {data?.map((list, index) => {
                return (
                  <div className="col-lg-3 col-4" key={index}>
                    <div className="locationItem">
                      <figure>
                        <Link to={`/network/${list.name}`}>
                          <img
                            src={
                              BASE_IMAGE_URL + "/uploads/states/" + list.image
                            }
                            alt=""
                          />
                        </Link>
                      </figure>
                      <h4>{list.name}</h4>
                    </div>
                  </div>
                );
              })}
            </div>
          </div>
        </div>
      </div>
    </>
  );
};

export default Network;
