import "swiper/css";
import "swiper/css/pagination";
import "swiper/css/navigation";
import "./assets/sources.css";
import "./assets/style.css";
import "./App.css";
import { BrowserRouter } from "react-router-dom";
import AppRoutes from "./routes";
import { fetchSiteSettings } from "../Redux/ActionCreater";
import { useDispatch } from "react-redux";
import { useEffect } from "react";
import { ToastContainer } from "react-toastify";
import GoogleTranslate from "./GoogleTranslate";
function App() {
  let dispatch = useDispatch();

  useEffect(() => {
    dispatch(fetchSiteSettings());
  }, []);
  return (
    <BrowserRouter basename="/">
      {/* <GoogleTranslate /> */}
      <AppRoutes />
      <ToastContainer style={{ zIndex: "999999999" }} />
    </BrowserRouter>
  );
}

export default App;
