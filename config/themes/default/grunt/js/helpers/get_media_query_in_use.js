A17.Helpers.get_media_query_in_use = function() {
  /*

    # A17.Helpers.get_media_query_in_use
    * v.1

    ## description
    Returns the current media query in use by looking at the font-family of the head of the document and text in some pseudo content

    ## requires
    * specific HTML

    ## parameters
    * none

    ## returns
    * media query string as a string

    ## example usage:
    var mq = A17.Helpers.get_media_query_in_use();

    ## HTML required
    body {
    }
      body:after {
        font: 0/0 a;
        color: transparent;
        text-shadow: none;
        width: 1px;
        height: 1px;
        margin: -1px 0 0 -1px;
        position: absolute;
        left: -1px;
        top: -1px;
      }
      @media (max-width: 767px) {
        head {
          font-family: 'small';
        }
        body:after {
          content: 'small';
        }
      }
      @media (max-width: 768px) {
        head {
          font-family: 'medium';
        }
        body:after {
          content: 'medium';
        }
      }
  */

  if (window.opera){
    return parse(window.getComputedStyle(document.body,":after").getPropertyValue("content")) || "large";
  } else if (window.getComputedStyle) {
    return parse(window.getComputedStyle(document.head,null).getPropertyValue("font-family")) || "large";
  } else {
    return "large";
  }

  function parse(str) {
    return str.replace(/'/gi,"").replace(/"/gi,"");
  }
};
