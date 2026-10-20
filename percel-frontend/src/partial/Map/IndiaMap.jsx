import React, { useMemo } from "react";
import { useNavigate } from "react-router-dom";
import {
  ComposableMap,
  Geographies,
  Geography,
  Marker
} from "react-simple-maps";
import { feature } from "topojson-client";
import { geoCentroid } from "d3-geo";

import indiaTopo from "./indiaTopo.json";

const IndiaMap = ({data=[]}) => {
  const navigate = useNavigate();

  const stateGeoJson = useMemo(() => {
    return feature(indiaTopo, indiaTopo.objects.states);
  }, []);

  const handleClick = (geo) => {
    const stateName = geo.properties.st_nm;
    navigate(`/network/${encodeURIComponent(stateName)}`);
  };

  return (
    <div style={{ width: "auto", margin: "auto" }}>
      <ComposableMap
        projection="geoMercator"
        projectionConfig={{
          scale: 900,
          center: [82, 22]
        }}
        style={{ width: "100%", height: "auto" }}
      >
        <Geographies geography={stateGeoJson}>
          {({ geographies }) => (
            <>
              {geographies.map((geo) => 
               { const stateName = geo.properties.st_nm;
                let a = data.length>0&&data.find(i=>i.name==stateName)
               return<Geography
                  key={geo.rsmKey}
                  geography={geo}
                  onClick={() => a?.name&&handleClick(geo)}
                  style={{
                    default: {
                      fill: "#6eeeff36",
                      stroke: "#9e9e9e",
                      strokeWidth: 0.3,
                      outline: "none"
                    },
                    hover: {
                      fill: a?.name?"#e9a822":"#6eeeff36",
                      stroke: a?.name?"#fff":"#9e9e9e",
                      strokeWidth: a?.name?0.6:0.3,
                      outline: "none",
                      cursor: a?.name?"pointer":"not-allowed"
                    },
                    pressed: {
                      fill: a?.name?"#e9a822":"#6eeeff36",
                      stroke: a?.name?"#fff":"#9e9e9e",
                      strokeWidth: a?.name?0.6:0.3,
                      outline: "none",
                      cursor: a?.name?"pointer":"not-allowed"
                    }
                  }}
                />}
              )}

              {geographies.map((geo) => {
                const centroid = geoCentroid(geo);
                const stateName = geo.properties.st_nm;
                let a = data.length>0&&data.find(i=>i.name==stateName)
                return (
                 a?.name&& <Marker
                    key={`${geo.rsmKey}-label`}
                    coordinates={centroid}
                    onClick={() => handleClick(geo)}
                    title={stateName}
                  >
                    <g
                      transform="translate(0, -8)"
                      style={{ cursor: "pointer" }}
                    >
                      {/* location pointer icon */}
                      <path
                        d="M0,-6 C2.5,-6 4.5,-4.2 4.5,-1.8 C4.5,1.2 0,6 0,6 C0,6 -4.5,1.2 -4.5,-1.8 C-4.5,-4.2 -2.5,-6 0,-6 Z"
                        fill="#e9a822"
                        stroke="#fff"
                        strokeWidth="0.5"
                      />
                      <circle cx="0" cy="-1.8" r="1.2" fill="#fff" />
                    </g>

                    <text
                      textAnchor="middle"
                      y={5}
                      style={{
                        fontFamily: "sans-serif",
                        fontSize: "7px",
                        fill: "#222",
                        fontWeight: 600,
                        pointerEvents: "none"
                      }}
                    >
                      {stateName}
                    </text>
                  </Marker>
                );
              })}
            </>
          )}
        </Geographies>
      </ComposableMap>
    </div>
  );
};

export default IndiaMap;