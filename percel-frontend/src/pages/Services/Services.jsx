import React, { useEffect, useState } from 'react'
import { Banner } from '../../partial/Component/Banner.jsx'
import ServiceSection from './ServiceSection.jsx';
import { BASE_URL } from '../../../config.js';
import axios from 'axios';

const Services = () => {
  const [data, setData] = useState([]);
  const [bannerData, setBannerData] = useState({});
  const [page, setPage] = useState(1);
  const [lastPage, setLastpage] = useState(1);
  const [perPage] = useState(10);
  const [loading, setLoading] = useState(false);

  // ✅ Fetch Services (Append logic)
  const fetchData = async (p = 1) => {
    try {
      setLoading(true);

      const res = await axios.get(`${BASE_URL}/services?page=${p}&per_page=${perPage}`);

      if (res.data.status === 1) {
        const newServices = res.data.responseData.services;

        setData(prev =>
          p === 1 ? newServices : [...prev, ...newServices]
        );

        setPage(res.data.responseData.pagination.current_page);
        setLastpage(res.data.responseData.pagination.last_page);
      }
    } catch (error) {
      console.log(error);
    } finally {
      setLoading(false);
    }
  };

  // ✅ Load More Function
  const loadMore = () => {
    if (page < lastPage && !loading) {
      fetchData(page + 1);
    }
  };

  // ✅ Fetch Banner
  const fetchBanner = async () => {
    try {
      const res = await axios.post(`${BASE_URL}/banner`, { slug: "service" });

      if (res.data.status === 1) {
        setBannerData(res.data.responseData.banner[0] ?? {});
      }
    } catch (error) {
      console.log(error);
    }
  };

  useEffect(() => {
    fetchBanner();
    fetchData(1); // first load
  }, []);

  return (
    <>
      {bannerData.image && <Banner data={bannerData} />}

      {data.length > 0 && (
        <div className="">
          <ServiceSection
            data={data}
            page={page}
            lastPage={lastPage}
            onLoadMore={loadMore}
            loading={loading}
          />
        </div>
      )}
    </>
  );
};

export default Services;