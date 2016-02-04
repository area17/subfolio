A17.Helpers.trigger_event = function(type, data, context) {
  var event = document.createEvent('HTMLEvents');
  event.initEvent(type, true, true);
  event.eventName = type;
  event.data = data || {};
  context = context || document;
  event.target = context;
  context.dispatchEvent(event);
};
