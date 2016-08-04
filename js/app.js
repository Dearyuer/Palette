
// console.log(PARTICLES_EFFECT_SETTINGS);


(function(){
var settings = 
{
  "particles": {
    "number": {
      "value": PARTICLES_EFFECT_SETTINGS["number"] || 13,
      "density": {
        "enable":(PARTICLES_EFFECT_SETTINGS["density"] == -1) ? false : true,
        "value_area": PARTICLES_EFFECT_SETTINGS["density_area"] || 800
      }
    },
    "color": {
      "value": PARTICLES_EFFECT_SETTINGS["color"] || "#666666"
    },
    "shape": {
      "type": PARTICLES_EFFECT_SETTINGS["shape"] || ["circle"],
      "stroke": {
        "width": PARTICLES_EFFECT_SETTINGS["stroke_width"] || 0,
        "color": PARTICLES_EFFECT_SETTINGS["stroke_color"] || "#000000"
      },
      "polygon": {
        "nb_sides": PARTICLES_EFFECT_SETTINGS["polygon_sides"] || 5
      },
      "image": {
        "src":  PARTICLES_EFFECT_SETTINGS["image_src"] || "img/github.svg",
        "width": PARTICLES_EFFECT_SETTINGS["image_width"] || 100,
        "height": PARTICLES_EFFECT_SETTINGS["image_height"] || 100
      }
    },
    "opacity": {
      "value": PARTICLES_EFFECT_SETTINGS["opacity_value"] || 0.5,
      "random": (PARTICLES_EFFECT_SETTINGS["random_opacity"] == -1) ? false : true,
      "anim": {
        "enable": +PARTICLES_EFFECT_SETTINGS["opacity_animation"] || false,
        "speed": PARTICLES_EFFECT_SETTINGS["opacity_animation_speed"] || 1,
        "opacity_min": PARTICLES_EFFECT_SETTINGS["minimum_animation_opacity"] || 0.1,
        "sync": +PARTICLES_EFFECT_SETTINGS["sync_opacity_anim"] || false
      }
    },
    "size": {
      "value": PARTICLES_EFFECT_SETTINGS["size_value"] || 5,
      "random": (PARTICLES_EFFECT_SETTINGS["random_size"] == -1) ? false : true,
      "anim": {
        "enable": +PARTICLES_EFFECT_SETTINGS["size_animation"] || false,
        "speed": PARTICLES_EFFECT_SETTINGS["size_animation_speed"] || 40,
        "size_min": PARTICLES_EFFECT_SETTINGS["minimum_animation_size"] || 0.1,
        "sync": +PARTICLES_EFFECT_SETTINGS["sync_size_anim"] || false
      }
    },
    "line_linked": {
      "enable": (PARTICLES_EFFECT_SETTINGS["line_linked"] == -1) ? false : true,
      "distance": PARTICLES_EFFECT_SETTINGS["linked_line_distance"] || 150,
      "color": PARTICLES_EFFECT_SETTINGS["linked_line_color"] || "#666666",
      "opacity": PARTICLES_EFFECT_SETTINGS["linked_line_opacity"] || 0.4,
      "width": PARTICLES_EFFECT_SETTINGS["linked_line_width"] || 1
    },
    "move": {
      "enable": (PARTICLES_EFFECT_SETTINGS["move"] == -1) ? false : true,
      "speed": PARTICLES_EFFECT_SETTINGS["move_speed"] || 6,
      "direction": PARTICLES_EFFECT_SETTINGS["move_direction"] || "none",
      "random": +PARTICLES_EFFECT_SETTINGS["random_move"] || false,
      "straight": +PARTICLES_EFFECT_SETTINGS["straight_move"] || false,
      "out_mode": PARTICLES_EFFECT_SETTINGS["out_mode"] || "out",
      "attract": {
        "enable": +PARTICLES_EFFECT_SETTINGS["attract_adjacent"] || false,
        "rotateX": PARTICLES_EFFECT_SETTINGS["offset_rotate_x"] || 600,
        "rotateY": PARTICLES_EFFECT_SETTINGS["offset_rotate_y"] || 1200
      }
    }
  },
  "interactivity": {
    "detect_on": PARTICLES_EFFECT_SETTINGS["detect_context"] || "canvas",
    "events": {
      "onhover": {
        "enable": +PARTICLES_EFFECT_SETTINGS["hover_effect"] || false,
        "mode": PARTICLES_EFFECT_SETTINGS["hover_effect_mode"] || "grab"
      },
      "onclick": {
        "enable": +PARTICLES_EFFECT_SETTINGS["click_effect"] || false,
        "mode": PARTICLES_EFFECT_SETTINGS["click_effect_mode"] || "push"
      },
      "resize": true
    },
    "modes": {
      "grab": {
        "distance": PARTICLES_EFFECT_SETTINGS["linked_line_dis_inter"] || 200,
        "line_linked": {
          "opacity": PARTICLES_EFFECT_SETTINGS["linked_line_opacity_inter"] || .5
        }
      },
      "bubble": {
        "distance": 400,
        "size": 40,
        "duration": 2000,
        "opacity": 0.8,
        "speed": 200
      },
      "repulse": {
        "distance": PARTICLES_EFFECT_SETTINGS["repulse_number"] || 200
      },
      "push": {
        "particles_nb": PARTICLES_EFFECT_SETTINGS["push_number"] || 4
      },
      "remove": {
        "particles_nb": PARTICLES_EFFECT_SETTINGS["remove_number"] || 2
      }
    }
  },
  "retina_detect": true
}
// console.log(settings);
particlesJS('particles-js',settings);


})();

// ,
//     "config_demo": {
//       "hide_card": false,
//       "background_color": "#b61924",
//       "background_image": "",
//       "background_position": "50% 50%",
//       "background_repeat": "no-repeat",
//       "background_size": "cover"
//     }


(function(){
  var document = this.document;
  var body = document.body,
      html = document.documentElement;
  var canvas = document.getElementById("particles-js").firstChild;
  var height = Math.max( body.scrollHeight, body.offsetHeight, 
                       html.clientHeight, html.scrollHeight, html.offsetHeight ) - 66*2;
  canvas.style.height = height + "px";
  var event = new Event('resize');
  this.dispatchEvent(event);
  // function addEvent(evnt, elem, func) {
  //    if (elem.addEventListener)  // W3C DOM
  //       elem.addEventListener(evnt,func,false);
  //    else if (elem.attachEvent) { // IE DOM
  //       elem.attachEvent("on"+evnt, func);
  //    }
  //    else { // No much to do
  //       elem[evnt] = func;
  //    }
  // }
  var resizeFunc = function(e){
        height = Math.max( body.offsetHeight, html.scrollHeight, html.offsetHeight ) - 66*2;
        canvas.style.height = height + "px";
    };
  if(this.addEventListener){
    this.addEventListener('resize',resizeFunc);
  }else if(this.attachEvent){
    this.attachEvent("onresize",resizeFunc);
  }else{
    throw new Error("Event error!");
  }
  

}).call(this);
