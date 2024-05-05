import React, { useState, useEffect } from 'react';
import './MembersList.css'; // Make sure your CSS styles are properly linked

function MembersList() {
  const [members, setMembers] = useState([]);

  useEffect(() => {
    fetch('https://iutdijon.u-bourgogne.fr/intra/iq/presque24/queensannesrevenge/')
      .then(response => response.json())
      .then(data => setMembers(data))
      .catch(error => console.error('Error fetching data:', error));
  }, []);

  return (
    <div className="members-list">
      {members.map((member, index) => (
        <div key={member.id} className={`member-card ${index % 2 === 0 ? 'normal' : 'reverse'}`}>
          <div className="member-image">
            <img src={`/img/captain.webp`} alt={member.name} />
          </div>
          <div className="member-info">
            <h2>{member.name}</h2>
            <p>{`Born: ${member.birth} - Died: ${member.death}`}</p>
            <p>{member.description}</p>
          </div>
        </div>
      ))}
    </div>
  );
}

export default MembersList;
