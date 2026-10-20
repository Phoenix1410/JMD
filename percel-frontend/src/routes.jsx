import React, { Suspense } from "react";
import { Routes, Route, Navigate } from "react-router-dom";
import { lazy } from "react";
import { useEffect, useState } from "react";
import { useLocation } from "react-router-dom";

const Home = lazy(() => import("./pages/Home/Home"));
const Services = lazy(() => import("./pages/Services/Services"));
const Network = lazy(() => import("./pages/Network/Network"));
const Tracking = lazy(() => import("./pages/Tracking/Tracking"));
const About = lazy(() => import("./pages/AboutUs/AboutUs"));
const Career = lazy(() => import("./pages/Career/Career"));
const Cmspage = lazy(() => import("./pages/Cmspage/Cmspage"));
const Networkdetails = lazy(
  () => import("./pages/Networkdetails/Networkdetails"),
);
import MainLayout from "./layouts/MainLayout";

const isAuthenticated = () => {
  return localStorage.getItem("token");
};

const PrivateRoute = ({ children }) => {
  return isAuthenticated() ? children : <Navigate to="/login" replace />;
};

const RouteLoader = () => {
  const { pathname } = useLocation();
  const [loading, setLoading] = useState(false);

  useEffect(() => {
    setLoading(true);

    window.scrollTo({
      top: 0,
      behavior: "smooth",
    });

    const timer = setTimeout(() => {
      setLoading(false);
    }, 1000);

    return () => clearTimeout(timer);
  }, [pathname]); // 👈 only runs when page changes

  return loading ? (
    <div className="loading-screen" id="loadingScreen">
      <div className="spinner"></div>
    </div>
  ) : null;
};

function AppRoutes() {
  return (
    <Suspense fallback={null}>
      <RouteLoader />
      <Routes>
        <Route element={<MainLayout />}>
          <Route path="/" element={<Home />} />
          <Route path="/services" element={<Services />} />
          <Route path="/network" element={<Network />} />
          <Route path="/network/:id" element={<Networkdetails />} />
          <Route path="/tracking" element={<Tracking />} />
          <Route path="/about" element={<About />} />
          <Route path="/privacy-policy" element={<Cmspage />} />
          <Route path="/career" element={<Career />} />
        </Route>
        <Route path="/*" element={<Navigate to="/" />} />
      </Routes>
    </Suspense>
  );
}

export default AppRoutes;
