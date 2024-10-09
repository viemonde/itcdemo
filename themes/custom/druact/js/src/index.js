import React from 'react';
import ReactDOM from 'react-dom';
import { BrowserRouter, Route, Routes } from 'react-router-dom';
import Page from './pages/Page';
 
const rootElement = document.getElementById('root');
const aliasPath = rootElement.getAttribute('data-alias');
const lang = rootElement.getAttribute('data-lang');
const App = () => (
  <BrowserRouter>
    <Routes>
      <Route path="*" element={<Page alias={aliasPath} lang={lang} />} />
    </Routes>  
  </BrowserRouter>
);

ReactDOM.render(<App ></App>, rootElement);
