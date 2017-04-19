var allSpecialties = [
  {
    name: "Allergy/Immunology",
    id: 1000,
    emPrice: '$2.85',
    procedurePrice: '$6.85',
    active: false
  },
  {
    name: "Anesthesiology",
    id: 1001,
    emPrice: '$2.85',
    procedurePrice: '$6.85',
    active: false
  },
  {
    name: "Cardiology",
    id: 1002,
    emPrice: '$2.85',
    procedurePrice: '$6.85',
    active: true
  },
  {
    name: "Dermatology",
    id: 1003,
    emPrice: '$2.65',
    procedurePrice: '$6.65',
    active: true
  },
  {
    name: "Emergency Medicine",
    id: 1004,
    emPrice: '$2.65',
    procedurePrice: '$6.65',
    active: false
  },
  {
    name: "Endocrinology",
    id: 1005,
    emPrice: '$2.75',
    procedurePrice: '$6.75',
    active: false
  },
  {
    name: "Family Practice",
    id: 1006,
    emPrice: '$2.55',
    procedurePrice: '$6.55',
    active: false
  },
  {
    name: "General Practice",
    id: 1007,
    emPrice: '$2.55',
    procedurePrice: '$6.55',
    active: false
  },
  {
    name: "Geriatrics",
    id: 1008,
    emPrice: '$2.55',
    procedurePrice: '$6.55',
    active: false
  },
  {
    name: "Internal Medicine",
    id: 1009,
    emPrice: '$2.65',
    procedurePrice: '$6.65',
    active: true
  },
  {
    name: "Medical Genetics",
    id: 1010,
    emPrice: '$2.85',
    procedurePrice: '$6.85',
    active: false
  },
  {
    name: "Neurological Surgery",
    id: 1011,
    emPrice: '$2.85',
    procedurePrice: '$6.85',
    active: false
  },
  {
    name: "Neurology",
    id: 1012,
    emPrice: '$2.85',
    procedurePrice: '$6.85',
    active: false
  },
  {
    name: "Obstetrics/Gynecology",
    id: 1013,
    emPrice: '$2.75',
    procedurePrice: '$6.75',
    active: false
  },
  {
    name: "Oncology",
    id: 1014,
    emPrice: '$2.85',
    procedurePrice: '$6.85',
    active: false
  },
  {
    name: "Ophthalmology",
    id: 1015,
    emPrice: '$2.65',
    procedurePrice: '$6.65',
    active: false
  },
  {
    name: "Orthopedics",
    id: 1016,
    emPrice: '$2.85',
    procedurePrice: '$6.85',
    active: false
  },
  {
    name: "Otolaryngology",
    id: 1017,
    emPrice: '$2.85',
    procedurePrice: '$6.85',
    active: false
  },
  {
    name: "Pathology",
    id: 1018,
    emPrice: '$2.85',
    procedurePrice: '$6.85',
    active: false
  },
  {
    name: "Pediatrics",
    id: 1019,
    emPrice: '$2.65',
    procedurePrice: '$6.65',
    active: false
  },
  {
    name: "Physical Medicine & Rehab",
    id: 1020,
    emPrice: '$2.65',
    procedurePrice: '$6.65',
    active: false
  },
  {
    name: "Plastic Surgery",
    id: 1021,
    emPrice: '$2.85',
    procedurePrice: '$6.85',
    active: false
  },
  {
    name: "Preventive Medicine",
    id: 1022,
    emPrice: '$2.65',
    procedurePrice: '$6.65',
    active: false
  },
  {
    name: "Psychiatry",
    id: 1023,
    emPrice: '$2.55',
    procedurePrice: '$6.55',
    active: false
  },
  {
    name: "Radiology",
    id: 1024,
    emPrice: '$2.55',
    procedurePrice: '$5.55',
    active: false
  },
  {
    name: "Surgery",
    id: 1025,
    emPrice: '$2.85',
    procedurePrice: '$6.85',
    active: false
  },
  {
    name: "Urology",
    id: 1026,
    emPrice: '$2.85',
    procedurePrice: '$6.85',
    active: false
  }
];

var allInsurance = [
  {
    name: "Medicare",
    id: 1100,
    active: false
  },
  {
    name: "Medicaid",
    id: 1101,
    active: true
  },
  {
    name: "Blue Cross Blue Shield",
    id: 1102,
    active: true
  }
];

var allEHR = [
  {
    name: "ADP",
    id: 1201,
    active: false
  },
  {
    name: "Allscripts",
    id: 1202,
    active: false
  },
  {
    name: "AmazingCharts.com, Inc.",
    id: 1203,
    active: false
  },
  {
    name: "Aprima Medical Software, Inc",
    id: 1204,
    active: false
  },
  {
    name: "athenahealth, Inc",
    id: 1205,
    active: false
  },
  {
    name: "Care360, Quest Diagnostics",
    id: 1206,
    active: false
  },
  {
    name: "Cerner Corporation",
    id: 1207,
    active: false
  },
  {
    name: "Chirotouch",
    id: 1208,
    active: false
  },
  {
    name: "CureMD",
    id: 1209,
    active: false
  },
  {
    name: "Dentrix",
    id: 1210,
    active: false
  },
  {
    name: "e-MDs, Inc.",
    id: 1211,
    active: false
  },
  {
    name: "Eaglesoft",
    id: 1212,
    active: false
  },
  {
    name: "eClinicalWorks LLC",
    id: 1213,
    active: false
  },
  {
    name: "Epic",
    id: 1214,
    active: true
  },
  {
    name: "GE Healthcare",
    id: 1215,
    active: false
  },
  {
    name: "Greenway Health",
    id: 1216,
    active: false
  },
  {
    name: "McKesson",
    id: 1217,
    active: false
  },
  {
    name: "MEDENT-Community Computer Service Inc.",
    id: 1218,
    active: false
  },
  {
    name: "MEDITECH",
    id: 1219,
    active: false
  },
  {
    name: "NexTech Systems Inc.",
    id: 1220,
    active: false
  },
  {
    name: "NextGen Healthcare",
    id: 1221,
    active: false
  },
  {
    name: "Office Ally",
    id: 1222,
    active: false
  },
  {
    name: "Practice Fusion",
    id: 1223,
    active: false
  },
  {
    name: "TRAKnet Solutions",
    id: 1224,
    active: false
  }
];
