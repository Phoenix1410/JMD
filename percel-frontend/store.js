import { configureStore } from "@reduxjs/toolkit";
import reducer from "./Redux/Reducer";

const store = configureStore({
  reducer: {
    data: reducer,
  },
  devTools: process.env.NODE_ENV !== "production",
});

export default store;
