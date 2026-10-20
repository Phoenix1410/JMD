import { useState } from "react";
import React from "react";
import weAreImg from "../../assets/images/we_are.jpg";
import { Markup } from "interweave";
import ImageComponent from "../../partial/Component/ImageComponent";


export default function Aboutme({data}) {

  return (
    <section className="serviceSec aboutmeSec">
        <div className="container">
            <div class="presencehding">
                <h2>{data.page_title}</h2>
            </div>
            <div className="abutepnel">
                <div className="media">
                   {data.featured_image&& <div className="abutemeimge">
                         <ImageComponent src={data.featured_image} alt="Banner" />
                    </div>}
                    <div className="media-object content_one">
                       <Markup content={data.page_content}/>
                    </div>
                </div>
            </div>
        </div>
    </section>
  );
}
