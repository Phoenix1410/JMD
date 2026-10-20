import React, { useEffect, useState } from 'react';
import axios from 'axios';
import { Link } from 'react-router-dom';
import { BASE_URL, BASE_IMAGE_URL } from "../../../config";
import IndiaMap from '../../partial/Map/IndiaMap';
import { Interweave } from 'interweave';
export const PresenceSection = ({data,title}) => {

  const [bannerData, setBannerData] = useState({});

  const fetchBanner = async () => {
    try {
      const res = await axios.post(`${BASE_URL}/banner`, {
        slug: "location"
      });

      if (res.data.status === 1) {
        setBannerData(res.data.responseData.banner[0] ?? {});
      }

    } catch (error) {
      console.log(error);
    }
  };

  useEffect(() => {
    fetchBanner();
  }, []);

  return (
    <>
      <div className="presenceNewSec">
        <div className="container">

          <div className="presencehding txtcenter">
            <h2>{title?.page_title}</h2>
            <p><Interweave content={title?.page_content} /></p>
          </div>

          <div className="presence_map">
            {/* <figure>
              <img
                src={
                  bannerData?.image
                    ? `${BASE_IMAGE_URL}/${bannerData.image}`
                    : ""
                }
                alt="presence map"
              />
            </figure> */}
            <IndiaMap data={data} />
          </div>

          <div className="presencebtn txtcenter">
            <Link to="/network" className='themebtn'>
              View All Location
            </Link>
          </div>

        </div>
      </div>
    </>
  );
};