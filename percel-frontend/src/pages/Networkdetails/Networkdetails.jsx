import React, { useEffect, useState } from "react";
import { useParams } from "react-router-dom";
import { BASE_URL } from "../../../config";
import axios from "axios";
import bxs_map from "../../assets/images/bxs_map.svg";
import { Banner } from "./Banner";
import { toast } from "react-toastify";

const Networkdetails = () => {
  const { id } = useParams();

  const [bannerData, setBannerData] = useState({});
  const [branches, setBranches] = useState([]);
  const [pagination, setPagination] = useState({});

  const [search, setSearch] = useState("");
  const [sort, setSort] = useState("asc");
  const [page, setPage] = useState(1);
  

  const fetchData = async () => {
    try {
      const res = await axios.get(`${BASE_URL}/branches`, {
        params: {
          name: id,
          search: search,
          sort: sort,
          page: page,
          per_page: 6,
        },
      });

      if (res.data.status === 1) {
        setBranches(res.data.responseData.branches);
        setPagination(res.data.responseData.pagination);

        setBannerData({
          title: res.data.responseData.banner?.title,
          image: "/uploads/states/" + res.data.responseData.banner?.image,
        });
      }
    } catch (error) {
      console.log(error);
    }
  };
const handleViewOnMap = (branch) => {
    if (branch?.google_link) {
      window.open(branch.google_link, "_blank", "noopener,noreferrer");
    } else {
      toast.error("Branch link not available. Please try another branch.");
    }
  };
  // API call on change
  useEffect(() => {
    fetchData();
  }, [id, search, sort, page]);

  return (
    <>
      {bannerData?.image && <Banner data={bannerData} />}

      <div className="secviceSec netowrkpage">
        <div className="container">
          <div className="presencehding txtcenter">
            <h2>Branches</h2>
          </div>

          {/* 🔍 Filters */}
          <div className="brnchfilter">
            <input
              type="text"
              placeholder="Search branches..."
              value={search}
              onChange={(e) => {
                setPage(1);
                setSearch(e.target.value);
              }}
            />

            <select
              value={sort}
              onChange={(e) => {
                setPage(1);
                setSort(e.target.value);
              }}
            >
              <option value="asc">A-Z</option>
              <option value="desc">Z-A</option>
            </select>
          </div>

          {/* 📍 Branch List */}
          <div className="row">
            {branches.length > 0 ? (
              branches.map((branch) => {
                console.log(branch);

                return (
                  <div className="col-lg-4 col-md-6" key={branch.id}>
                    <div className="locateItem">
                      <h3>{branch.branch_name}</h3>

                      <div className="locateinfo">
                        <p
                          className={`${branch.branch_type ? "bg-warning" : ""} col-md-4 text-center rounded text-bold`}
                        >
                          {branch?.branch_type || ""}
                        </p>
                        <p>
                          Address: <span>{branch.address}</span>
                        </p>
                        <p>
                          Contact:
                          <span>
                            {branch.contact_person} <br />
                            {branch.phone}
                            {branch.phone2 ? `, ${branch.phone2}` : ""}
                            {branch.phone3 ? `, ${branch.phone3}` : ""} <br />
                          </span>
                        </p>
                      </div>
                      <button
                        onClick={() =>  handleViewOnMap(branch)}
                      >
                        <img src={bxs_map} alt="" /> View On Map
                      </button>
                    </div>
                  </div>
                );
              })
            ) : (
              <div className="text-center mt-5">
                <h5>No branches found</h5>
              </div>
            )}
          </div>

          {/* 📄 Pagination */}
          {branches.length > 0 && (
            <div className="pagination-wrapper">
              <button
                className="page-btn"
                disabled={!pagination.prev_page_url}
                onClick={() => setPage(page - 1)}
              >
                ← Prev
              </button>

              <span className="page-info">
                Page {pagination.current_page} of {pagination.last_page}
              </span>
              <button
                className="page-btn"
                disabled={!pagination.next_page_url}
                onClick={() => setPage(page + 1)}
              >
                Next →
              </button>
            </div>
          )}
        </div>
      </div>
    </>
  );
};

export default Networkdetails;
