import axios from "axios";
import { useEffect, useState } from "react";
import { BASE_URL } from "../../../config";

export const BranchModal = ({ show, onClose, id }) => {
  if (!show) return null;

  let [branchData, setBranchData] = useState([]);
  let [search, setSearch] = useState("");

  let fetchData = async () => {
    try {
      await axios.post(`${BASE_URL}/branches`, { state_id: id })
        .then(res => {
          if (res.data.status === 1) {
            let result = res.data.responseData.branches.map(item => {
              return {
                id: item.id,
                code: item.branch_code,
                name: item.branch_name,
                address: item.address,
                state: item.state_name,
                contact: item.contact_person,
                phone: item.phone,
                email: item.email_address,
              }
            })
            setBranchData(result)
          }
        })
    } catch (error) {
      console.log(error)
    }
  }

  useEffect(() => {
    id && fetchData();
  }, [id])


  // 🔎 Filter data on all fields
  const filteredData = branchData.filter(branch =>
    Object.values(branch)
      .join(" ")
      .toLowerCase()
      .includes(search.toLowerCase())
  );


  return (
    <div className="modalOverlay">
      <div className="modalContainer">
        <div className="modalHeader">
          <h3 className="text-center">Our Branches</h3>
          <button className="closeBtn" onClick={onClose}>
            ✕
          </button>
        </div>

        {/* 🔎 Search Field */}
       <div className="search-box-branch">
          <input
            type="text"
            placeholder="Search branches by code, name, address, or phone number"
            className="searchField"
            value={search}
            onChange={(e) => setSearch(e.target.value)}
          />
        </div>

        <div className="tableWrapper">
           
          <table className="table table-bordered">
            <thead>
              <tr>
                <th>Branch Code</th>
                <th>Branch Name</th>
                <th>Address</th>
                <th>State</th>
                <th>Contact Person</th>
                <th>Phones</th>
                <th>Email Address</th>
              </tr>
            </thead>
            <tbody>
              {filteredData.length > 0 ? filteredData.map((branch, index) => (
                <tr key={index}>
                  <td>{branch.code}</td>
                  <td>{branch.name}</td>
                  <td>{branch.address?branch.address:"N/A"}</td>
                  <td>{branch.state}</td>
                  <td>{branch.contact}</td>
                  <td>{branch.phone}</td>
                  <td>{branch.email?branch.email:"N/A"}</td>
                </tr>
              )) : (
                <tr className="noDataRow">
                  <td colSpan={7}>
                    No branches available at the moment
                  </td>
                </tr>
              )}
            </tbody>
          </table>
        </div>

      </div>
    </div>
  );
};