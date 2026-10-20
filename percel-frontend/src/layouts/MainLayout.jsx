import React from "react";
import { Outlet } from "react-router-dom";
import Header from "../partial/Header";
import Footer from "../partial/Footer";

function MainLayout() {
  return (
    <>
     <Header/>
      <main>
        <Outlet />
      </main>
      <Footer/>
    </>
  );
}

export default MainLayout;
