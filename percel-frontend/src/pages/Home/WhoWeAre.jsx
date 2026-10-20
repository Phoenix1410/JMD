import React from "react";

import weAreImg from "../../assets/images/we_are.jpg";
import icon1 from "../../assets/images/icon-1.png";
import icon2 from "../../assets/images/icon-2.png";
import icon3 from "../../assets/images/icon-3.png";
import { Markup } from "interweave";

const WhoWeAre = ({data}) => {
  return (
    <div
      className="sec_two"
      style={{
        background: `url(${weAreImg}) no-repeat`,
        backgroundSize: "cover",
        backgroundPosition: "center",
      }}
    >
      <div className="container">
        <div className="row">
          <div className="col-lg-12">
            <div className="heading text-center">
              <h2>Who We Are?</h2>
            </div>
          </div>

          <div className="col-lg-12 margin_set">
            <div className="content_one d-flex gap-3">
              <Markup content={data.description}/>
             
            </div>
          </div>

          <img
            className="img-fluid weare"
            src={weAreImg}
            alt="Who We Are"
            style={{ width: "100%" }}
          />

          {/* <div className="col-lg-12">
            <div className="button_design text-center">
              <a href="#url">
                <span>View Details</span>
              </a>
            </div>
          </div> */}
        </div>

        {/* Bottom Boxes */}
        <div className="row">
          <div className="col-lg-4">
            <div className="box_item_set">
              <div className="top_set">
                <span>
                  <img src={icon1} alt="Vision" />
                </span>
                <h3>{data.vision_statement_title}</h3>
              </div>
              <p>
                {data.vision_statement_content}
              </p>
            </div>
          </div>

          <div className="col-lg-4">
            <div className="box_item_set">
              <div className="top_set">
                <span>
                  <img src={icon2} alt="Value" />
                </span>
                <h3>{data.our_value_title}</h3>
              </div>
              <p>
                {data.our_value_content}
              </p>
            </div>
          </div>

          <div className="col-lg-4">
            <div className="box_item_set">
              <div className="top_set">
                <span>
                  <img src={icon3} alt="Quality" />
                </span>
                <h3>{data.quality_policy_title}</h3>
              </div>
              <p>
                {data.quality_policy_content}
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
};

export default WhoWeAre;
