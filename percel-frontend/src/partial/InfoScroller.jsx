import { Markup } from 'interweave';
import React from 'react'
import { shallowEqual, useSelector } from 'react-redux';

const InfoScroller = () => {
   const { siteData } = useSelector(
        (state) => ({
            siteData: state.data.siteData,
        }),
        shallowEqual
    );
  return (
     <div class="marquee-container overflow-hidden">
      <Markup content={siteData.disclaimer}/>
        {/* <div class="marquee-content d-flex align-items-center">
            <div class="marquee-item">Our Customer Support team is reachable only from our website or app. Login with your phone number and raise your support request with us.</div>
            <div class="marquee-item">Please do not transfer money to payment links that are not shared from Delhive
            </div>
        </div> */}
    </div>
  )
}

export default InfoScroller