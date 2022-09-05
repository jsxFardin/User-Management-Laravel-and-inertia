<template>
  <div class="position-absolute overlay-loader-wrapper">
    <span
      class="
        spinner-bounce
        d-flex
        align-items-center
        justify-content-center
        h-100
      "
    >
      <span class="bounce1 mr-1" />
      <span class="bounce2 mr-1" />
      <span class="bounce3 mr-1" />
      <span class="bounce4" />
    </span>
  </div>
</template>

<style scoped>
.spinner-bounce > span {
  width: 9px;
  height: 9px;
  border-radius: 100%;
  display: inline-block;
  background-color: #e6e6e6;
  -webkit-animation: bounceDelay 1.4s infinite ease-in-out both;
  animation: bounceDelay 1.4s infinite ease-in-out both;
}

.spinner-bounce > span.bounce1 {
  -webkit-animation-delay: -0.32s;
  animation-delay: -0.32s;
}

.spinner-bounce > span.bounce2 {
  -webkit-animation-delay: -0.16s;
  animation-delay: -0.16s;
}

.overlay-loader-wrapper {
  top: 0;
  right: 0;
  bottom: 0;
  left: 0;
  border-radius: 0.25rem;
  z-index: 10000;
  width: 100vw;
  height: 100%;
  background: rgba(255, 255, 255, 0.4);
}

.overlay-loader-wrapper .spinner-bounce > span {
  width: 11px;
  height: 11px;
  background-color: #61a534;
}

@-webkit-keyframes bounceDelay {
  0%,
  80%,
  100% {
    -webkit-transform: scale(0);
  }

  40% {
    -webkit-transform: scale(1);
  }
}

@keyframes bounceDelay {
  0%,
  80%,
  100% {
    -webkit-transform: scale(0);
    transform: scale(0);
  }

  40% {
    -webkit-transform: scale(1);
    transform: scale(1);
  }
}
</style>
