import React, { useState } from "react";

import newsOne from "../../assets/images/news_one.jpg";
import newsTwo from "../../assets/images/news_two.jpg";
import { BASE_IMAGE_URL } from "../../../config";
import ImageComponent from "../../partial/Component/ImageComponent";

import { Swiper, SwiperSlide } from "swiper/react";
import { Pagination, Navigation } from "swiper/modules";

const NewsSection = ({ newsData }) => {
  const [expandedId, setExpandedId] = useState(null);

  const toggleReadMore = (id) => {
    setExpandedId(expandedId === id ? null : id);
  };

  const truncateText = (text, limit = 100) => {
    if (text.length <= limit) return text;
    return text.substring(0, limit) + "...";
  };

  return (
    <div className="sec_three">
      <div className="container">
        <div className="row">
          <div className="col-lg-12">
            <div className="sec_three_heading">
              <h2>News Updates</h2>
              {/* <a href="#url">
                <span>See All</span>
              </a> */}
            </div>
          </div>
        </div>

        <div className="row sec_three_last_row">
          {newsData.length > 0 && (
            <Swiper
             modules={[Navigation,Pagination]}
                    navigation={true}
                    pagination={false}
              spaceBetween={35}
              slidesPerView={1}
              loop={true}
              className="swiper-container"
              breakpoints={{
                768: {
                  slidesPerView: 2
                }
              }}
            >
              {newsData.map((item, index) => {
                const isExpanded = expandedId === item.id;

                return (
                  <SwiperSlide key={index}>
                    <div className="col-lg-12" key={item.id}>
                      <div className="media">
                        <ImageComponent
                          className="me-3"
                          src={item.image}
                          alt={item.heading}
                        />

                        <div className="media-body">
                          <div className="media-body-item">
                            <div className="media-body-item-heading">
                              <h3>{item.heading}</h3>
                              <h5>{item.created_at}</h5>
                            </div>

                            <div className="media-body-item-content">
                              <p>
                                {isExpanded
                                  ? item.content
                                  : truncateText(item.content)}

                                <span
                                  onClick={() => toggleReadMore(item.id)}
                                  className="seemore-btn"
                                >
                                  {isExpanded ? "less" : "more"}
                                </span>
                              </p>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </SwiperSlide>
                );
              })}
            </Swiper>
          )}

        </div>
      </div>
    </div>
  );
};

export default NewsSection;
