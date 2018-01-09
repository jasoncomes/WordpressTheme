// Scholarship
function sanitize_scholarship(item) {

  // Average
  if (item.avg) {
    item.avg = numberFormat(item.avg);
  }

  // Study Areas
  if (item.study_areas) {
    item.study_areas = capitlizedWords(item.study_areas);
  }

  // Renewable
  if (item.renewable) {
    item.renewable = item.renewable == 'Y' ? 'Yes' : 'No';
  }

  // Enrollement Levels
  var enrollment_levels = '';

  if (item.enrollment_levels && item.enrollment_levels[0] != '') {
    for (var key in item.enrollment_levels) {
      enrollment_levels += key != (item.enrollment_levels.length - 1) ? item.enrollment_levels[key] + ', ' : item.enrollment_levels[key] + ' ';
    }
  }

  item.enrollment_levels = enrollment_levels;

  // Return Item
  return item;

}


// Format Phone
function formatPhone(str) {
  return str.replace(/\D/g, '').substring(0, 10).replace(/(\d{3})(\d{3})(\d{4})/, '($1) $2-$3');
}


// Format Number
function numberFormat(num) {
  return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}


// Capitlized Words
function capitlizedWords(str) {
    return str.replace(/(?:^|\s)\S/g, function(a) 
    { 
      return a.toUpperCase(); 
    });
};

// Format Refined Tag Values
function formatRefineValues(item) {
  switch (item.attributeName) {
    case 'states':
      item = stateAbbrToName(item);
      break;
    case 'enrollment_levels':
    case 'races':
    case 'study_areas':
      item.name = capitlizedWords(item.name);
      break;
    case 'renewable':
      item.name = 'Renewablity: ' + (item.name == 'Y' ? 'Yes' : 'No');
      break;
    case 'sponsor.is_school':
      item.name = 'Sponsored by School: ' + (item.name == 'Y' ? 'Yes' : 'No');
      break;
    case 'min_gpa':
      if (item.name == '0') {
        item.name = 'Not Specified';
      } else if (item.name == '1' || item.name == '2' || item.name == '3' || item.name == '4') {
        item.name += '.0';
      }
      item.name = 'Minimum GPA: ' + item.name;
      break;
  }

  return item;
}

// Min GPA Label Transform
function minGPALabel(item) {
  var gpa = {
    "0": "Not Specified",
    "1": "1.0",
    "2": "2.0",
    "3": "3.0",
    "4": "4.0",
  };

  item.name = gpa[item.name] ? gpa[item.name] : item.name;
  item.highlighted = item.name;
  
  return item;
}

// State Abbreviation to Name
function stateAbbrToName(item) {
  var states = {
    "AA": "Armed Forces Americas",
    "AB": "Alberta",
    "AE": "Armed Forces Africa/Canada/Europe/Middle East",
    "AK": "Alaska",
    "AL": "Alabama",
    "AP": "Armed Forces Pacific",
    "AR": "Arkansas",
    "AS": "American Samoa",
    "AZ": "Arizona",
    "BC": "British Columbia",
    "CA": "California",
    "CO": "Colorado",
    "CT": "Connecticut",
    "DC": "District Of Columbia",
    "DE": "Delaware",
    "FL": "Florida",
    "FM": "Federated States Of Micronesia",
    "GA": "Georgia",
    "GU": "Guam",
    "HI": "Hawaii",
    "IA": "Iowa",
    "ID": "Idaho",
    "IL": "Illinois",
    "IN": "Indiana",
    "KS": "Kansas",
    "KY": "Kentucky",
    "LA": "Louisiana",
    "MA": "Massachusetts",
    "MB": "Manitoba",
    "MD": "Maryland",
    "ME": "Maine",
    "MH": "Marshall Islands",
    "MI": "Michigan",
    "MN": "Minnesota",
    "MO": "Missouri",
    "MP": "Northern Mariana Islands",
    "MS": "Mississippi",
    "MT": "Montana",
    "NB": "New Brunswick",
    "NC": "North Carolina",
    "ND": "North Dakota",
    "NE": "Nebraska",
    "NF": "Newfoundland and Labrador",
    "NH": "New Hampshire",
    "NJ": "New Jersey",
    "NL": "Newfoundland and Labrador",
    "NM": "New Mexico",
    "NS": "Nova Scotia",
    "NT": "Northwest Territories",
    "NU": "Nunavut",
    "NV": "Nevada",
    "NY": "New York",
    "OH": "Ohio",
    "OK": "Oklahoma",
    "ON": "Ontario",
    "OR": "Oregon",
    "PA": "Pennsylvania",
    "PE": "Prince Edward Island",
    "PR": "Puerto Rico",
    "PW": "Palau",
    "QC": "Québec",
    "RI": "Rhode Island",
    "SC": "South Carolina",
    "SD": "South Dakota",
    "SK": "Saskatchewan",
    "TN": "Tennessee",
    "TX": "Texas",
    "UT": "Utah",
    "VA": "Virginia",
    "VI": "Virgin Islands",
    "VT": "Vermont",
    "WA": "Washington",
    "WI": "Wisconsin",
    "WV": "West Virginia",
    "WY": "Wyoming",
    "YT": "Yukon"
  };

  item.name = states[item.name];
  item.highlighted = item.name;
  
  return item;
}