import React from 'react';
import ReactDOM from 'react-dom';
import {
  BrowserRouter,
  Routes,
  Route
} from "react-router-dom";
import Websites from './components/websites';
import Create from './components/create';
import Update from './components/update';
import registerServiceWorker from './registerServiceWorker';
import './website.css';
import './index.css';


ReactDOM.render(
  <BrowserRouter>
    <Routes>
      <Route path="/" element={<Websites />} />
      <Route path="create" element={<Create />} />
      <Route path="update" element={<Update />} />
    </Routes>
  </BrowserRouter>,

  document.getElementById('root')
);

registerServiceWorker();
