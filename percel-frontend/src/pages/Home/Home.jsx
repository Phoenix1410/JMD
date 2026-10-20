import React, { useEffect, useState } from 'react'
import BannerSlider from './BannerSlider'
import WhoWeAre from './WhoWeAre'
import NewsSection from './NewsSection'
import TestimonialSlider from './TestimonialSlider'
import { BASE_URL } from '../../../config'
import axios from 'axios'
import Aboutme from './Aboutme'
import TrackingSection from './TrackingSection'
import ServiceSection from './ServiceSection'
import { PresenceSection } from './PresenceSection'

const Home = () => {
   let [data,setData]=useState({});
   let [stateData,setStateData]=useState([]);
    let fetchData=async()=>{
    try {
      await axios.get(`${BASE_URL}/home-page-content`)
      .then(res=>{
        if(res.data.responseCode===1){
          setData(res.data.responseData);
        }
      })
    } catch (error) {
      console.log(error)
    }
  }
 let fetchStateData = async () => {
  try {
    const res = await axios.get(`${BASE_URL}/states`);

    if (res.data.status === 1) {
      setStateData(res.data.responseData.states); // should be array
    }

  } catch (error) {
    console.log(error);
  }
}
  useEffect(()=>{
    fetchData();
    fetchStateData()
  },[])
  return (
    data?.Headerbanner&&<>
    {/* <BannerSlider data={data.Headerbanner} /> */}
    {/* <WhoWeAre data={data.homecms}/> */}
    {/* <NewsSection newsData={data.newupdates}/> */}
    {/* <TestimonialSlider testimonials={data.testimonials}/> */}
    <TrackingSection data={data?.Headerbanner}/>
    <ServiceSection data={data?.services} title={data?.ourservice} />
    <PresenceSection data={stateData}  title={data?.ourpresence} />
    <Aboutme data={data?.cmdsdesk} />
    </>
  )
}

export default Home