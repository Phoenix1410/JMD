import { Swiper, SwiperSlide } from "swiper/react";
import { Pagination, Autoplay } from "swiper/modules";

import ImageComponent from "../../partial/Component/ImageComponent";

const BannerSlider = ({data}) => {
  return (
    <div className="banner_slider">
      <Swiper
        modules={[Pagination, Autoplay]}
        spaceBetween={0}
        slidesPerView={1}
        pagination={{ clickable: true }}
        autoplay={{ delay: 3000 }}
        loop={true}
        className="swiper-container"
      >
        {data.map((item, index) => (
          <SwiperSlide key={index}>
            <div className="swiper-slide">
              <div className="slider_container">
                <div className="container">
                  <div className="slider_container_bx">
                   {item.title&&<h2>{item.title}</h2>}
                    {item.sub_title&&<h4>{item.sub_title}</h4>}
                    {item.short_description&&<p>
                     {item.short_description}
                    </p>}
                    {/* <a className="btn_banner" href="#url">
                      <span>Learn More</span>
                    </a> */}
                  </div>
                </div>
              </div>

              <ImageComponent src={item.image} alt="Banner" />
            </div>
          </SwiperSlide>
        ))}
      </Swiper>
    </div>
  );
};

export default BannerSlider;
