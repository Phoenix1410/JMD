import React, { useEffect, useState } from "react";

const ProgressSection = ({
  result,
  setFormData,
  setResult,
  formRef,
  progessRef,
}) => {
  let [activity, setActivity] = useState(null);
  const groupByDate = (data) => {
    const grouped = data.reduce((acc, item) => {
      const existingGroup = acc.find((group) => group.date === item.date);

      if (existingGroup) {
        existingGroup.items.push(item);
      } else {
        acc.push({
          date: item.date,
          items: [item],
        });
      }

      return acc;
    }, []);

    return grouped;
  };

  const formatDate = (dateString) => {
    const [day, month, year] = dateString.split("-");

    // Create proper Date object (YYYY-MM-DD format required)
    const date = new Date(`${year}-${month}-${day}`);

    const options = { weekday: "long" };
    const dayName = date.toLocaleDateString("en-IN", options);

    return `${dayName}, ${day}/${month}/${year}`;
  };
  const scrollToSection = () => {
    const element = formRef.current;
    const yOffset = -10; // 10px above
    const y =
      element.getBoundingClientRect().top + window.pageYOffset + yOffset;

    window.scrollTo({ top: y, behavior: "smooth" });
  };
  useEffect(() => {
    let a = groupByDate(result.consignmentactivitylist);
    console.log(a);
    setActivity(a);
    if (result) {
      const element = progessRef.current;
      const yOffset = -10; // 10px above
      const y =
        element.getBoundingClientRect().top + window.pageYOffset + yOffset;

      window.scrollTo({ top: y, behavior: "smooth" });
    }
  }, [result]);
  return (
    <div className="delivery_progress" ref={progessRef}>
      <div className="container">
        <div className="presencehding">
          <h2>Delivery progress</h2>
          <span>Order ID: {result.consignmentdetail.grno}</span>
        </div>

        {/* <div className="progresspnel">
          <div className="tracking-wrapper">
            <div className="tracking-top">
              <div className="tranckcity">
                <strong>From:</strong>
                <span>{result.consignmentdetail.origin}</span>
              </div>
              <div className="tranckcity">
                <strong>To:</strong>
                <span>{result.consignmentdetail.destname}</span>
              </div>
            </div>

            <div className="progress-container">
              <div className="progress-line default"></div>
              <div
                className="progress-line"
                style={{
                  width: `${25 * result.consignmentactivitylist.length}%`,
                }}
              ></div>

              <div className="step">
                <div
                  className="circle"
                  style={{
                    background:
                      result.consignmentactivitylist.length >= 1
                        ? "#009E00"
                        : "#ccc",
                  }}
                ></div>
                <p>Booked</p>
              </div>

              <div className="step">
                <div
                  className="circle"
                  style={{
                    background:
                      result.consignmentactivitylist.length >= 2
                        ? "#009E00"
                        : "#ccc",
                  }}
                ></div>
                <p>DESPATCH</p>
              </div>

              <div className="step">
                <div
                  className="circle"
                  style={{
                    background:
                      result.consignmentactivitylist.length >= 3
                        ? "#009E00"
                        : "#ccc",
                  }}
                ></div>
                <p>ARRIVAL</p>
              </div>

              <div className="step">
                <div
                  className="circle"
                  style={{
                    background:
                      result.consignmentactivitylist.length >= 4
                        ? "#009E00"
                        : "#ccc",
                  }}
                ></div>
                <p>Delivered</p>
              </div>
            </div>
          </div>

          {result.consignmentactivitylist.length > 2 && (
            <div className="progresscont">
              <h3>
                Delivered on <br />{" "}
                {formatDate(
                  result.consignmentactivitylist[
                    result.consignmentactivitylist.length - 1
                  ]?.date,
                )}
              </h3>
              <strong>Signed by: {result.consignmentdetail.cngr}</strong>
            </div>
          )}
        </div> */}

        <div className="shipment_history">
          <h2>Shipment History</h2>

          <div className="shipmentpnel">
            {activity &&
              activity.map((item, index) => (
                <div className="historyitem" key={index}>
                  <h3>{formatDate(item.date)}</h3>
                  <ul>
                    {item.items.map((i, index) => (
                      <li>
                        {/* <i>11:28 AM</i> */}
                        <span>{i.details}</span>
                        <em>{i.activity}</em>
                      </li>
                    ))}
                  </ul>
                </div>
              ))}
          </div>

          <div className="trackbtn">
            <button
              onClick={(e) => {
                setResult(null);
                setFormData({ trackingId: "", phone: "" });
                scrollToSection();
              }}
            >
              Track Another Shipment
            </button>
          </div>
        </div>
      </div>
    </div>
  );
};

export default ProgressSection;
