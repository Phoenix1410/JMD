import axios from "axios";
import { BASE_URL } from "../config";
import {
  SET_SITE_DATA,
  SET_USER_DATA,
  SET_LOADING
} from "./Action";
import { toast } from "react-toastify";

/* ---------------- Actions ---------------- */

export const setLoading = (isLoading) => ({
  type: SET_LOADING,
  payload: Boolean(isLoading),
});

export const setSiteData = (data) => ({
  type: SET_SITE_DATA,
  payload: data,
});

export const setUserData = (data) => ({
  type: SET_USER_DATA,
  payload: data,
});


export const fetchSiteSettings = () => async (dispatch) => {
  dispatch(setLoading(true));

  try {
    const res = await axios.get(`${BASE_URL}/siteinfo`);

    if (res.data?.responseCode === 1) {
      dispatch(setSiteData(res.data.responseData));
    } else {
      toast.error("Failed to load site settings");
    }
  } catch (error) {
    console.error("Site settings error:", error);
    toast.error("Something went wrong. Please try again.");
  } finally {
    dispatch(setLoading(false));
  }
};


export const logout = (navigate, msg = "Logged out successfully") => async (dispatch) => {
  try {
    // Clear storage first
    localStorage.removeItem("token");
    localStorage.removeItem("log_in_data");

    // Reset redux state
    dispatch(setUserData({}));

    // UI feedback
    toast.dismiss();
    toast.warning(msg);

    // Redirect
    navigate("/", { replace: true });

  } catch (error) {
    console.error("Logout error:", error);
    toast.error("Logout failed");
  }
};







