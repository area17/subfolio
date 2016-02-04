A17.Helpers.doc_height = function() {
  return Math.max(
    document.documentElement.clientHeight,
    document.body.scrollHeight, document.documentElement.scrollHeight,
    document.body.offsetHeight, document.documentElement.offsetHeight);
};
