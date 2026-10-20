import React, { useEffect, useState } from "react";
import presenceBg from "../../assets/images/presenceback.jpg";
import marqueeImg from "../../assets/images/marqueItem.jpg";
import "./mq.css"
import axios from "axios";
import { BASE_URL } from "../../../config";
import { BranchModal } from "./BranchModal";
import { Markup } from "interweave";


export const ContentSection = ({ data }) => {
    const [showModal, setShowModal] = useState(false);
    const [selectedId, setSelectedId] = useState(null);
    let [marqueeData, setMarqueeData] = useState([[], [], []])
    const splitIntoThree = (arr) => {
        const size = Math.ceil(arr.length / 3);

        return [
            arr.slice(0, size),
            arr.slice(size, size * 2),
            arr.slice(size * 2)
        ];
    };
    let fetchData = async () => {
        try {
            await axios.get(`${BASE_URL}/states`)
                .then(res => {
                    if (res.data.status === 1) {
                        const result = splitIntoThree(res.data.responseData.states);
                        setMarqueeData(result)
                    }
                })
        } catch (error) {
            console.log(error)
        }
    }
    useEffect(() => {

        fetchData();
    }, [])
    return (
        <>
            <div
                className="presenceSec"
                style={{ backgroundImage: `url(${presenceBg})` }}
            >
                <div className="container">
                    <div className="presencehding">
                        <h2>{data.page_title}</h2>
                        <Markup content={data.page_content}/>
                    </div>
                </div>

                <div className="presenceSlder">
                    {marqueeData.map((group, index) => (
                        <MarqueeRow
                            key={index}
                            group={group}
                            direction={(index + 1) % 2 === 0 ? "rtl" : "ltr"}
                            setShowModal={setShowModal}
                            setSelectedId={setSelectedId}
                        />
                    ))}
                </div>
            </div>
            <BranchModal
                show={showModal}
                onClose={() => setShowModal(false)}
                id={selectedId}
            />
        </>
    );
};

const MarqueeRow = ({ group, direction, setShowModal, setSelectedId }) => {
    const items = [...group, ...group];

    return (
        <div className={`customMarquee ${direction}`}>
            <div className="marqueeTrack">
                {items.map((state, idx) => (
                    <div className="marqueeItem" key={`${state.name}-${idx}`}>
                        <a className="marquebtns" onClick={(e) => { e.preventDefault(); setShowModal(true); setSelectedId(state.id) }} href="#">
                            <span>{state.name}</span>
                            {/* <i>
                                <img src={marqueeImg} alt={state.name} />
                            </i> */}
                        </a>
                    </div>
                ))}
            </div>
        </div>
    );
};