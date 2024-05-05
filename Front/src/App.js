// App.js
import React from 'react';
import './App.css'; // Ensure global styles are imported
import Banner from './Banner';
import MembersList from './MembersList';

function App() {
  return (
    <div className="App">
      <Banner />
      <div className="wind-effect">
        <span className="wind-text">~~~</span>
        <span className="wind-text">~~~</span>
        <span className="wind-text">~~~</span>
      </div>
      <div className="section-title">Nos Membres</div>
      <div className="wave-container">
        <svg viewBox="0 0 500 150" preserveAspectRatio="none" style={{height: '100%', width: '100%'}}>
          <path d="M0,60 C150,200 350,0 500,60 L500,150 L0,150 Z" style={{stroke: 'none', fill: '#ffffff'}}>
            <animate repeatCount="indefinite" fill="freeze" attributeName="d" dur="10s" attributeType="XML"
              values="M0,60 C150,200 350,0 500,60 L500,150 L0,150 Z;
                      M0,60 C150,0 350,200 500,60 L500,150 L0,150 Z;
                      M0,60 C150,200 350,0 500,60 L500,150 L0,150 Z" />
          </path>
        </svg>
      </div>
      <MembersList />
    </div>
  );
}

export default App;
