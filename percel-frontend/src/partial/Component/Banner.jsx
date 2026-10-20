import React from 'react'
import ImageComponent from './ImageComponent';
export const Banner = ({data}) => {
  return (
   <div className="bnersec inrBner">
      <div className="bnerimge">
        {/* <img src={banner1} alt="Services Banner" /> */}
        <ImageComponent src={data.image} alt="Services Banner"/>
        <div className="bnertxt">
          <div className="container">
            <div className="bnertxtinr">
              <h1>{data.title}</h1>
            </div>
          </div>
        </div>

      </div>
    </div>
  )
}
