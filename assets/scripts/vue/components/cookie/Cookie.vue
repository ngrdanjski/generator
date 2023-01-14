<template>
  <div v-if="!isSet" class="cookies">
    <div class="cookies__inner">
      <div class="cookies__text">
        <a class="cookies__text-link" :href="cookiePageUrl">{{ linkText }}</a>
        <span>{{ textText }}</span>
      </div>
      <div class="cookies__button-wrapper">
        <button @click="close" class="vb-button vb-button--cookie">{{ buttonText }}</button>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "Cookies",
  props: {
    linkText: {
      type: String,
      required: false
    },
    textText: {
      type: String,
      required: false
    },
    buttonText: {
      type: String,
      required: false
    },
    cookiePageUrl: {
      type: String,
      required: false
    },
  },
  data() {
    return {
      cookie: false,
      isSet: false
    }
  },
  mounted() {
    if (localStorage.getItem('barfCookies')) this.isSet = true
  },
  methods: {
    close() {
      localStorage.setItem('barfCookies', true)
      this.isSet = true
    }
  }
}
</script>

<style lang="scss" scoped>
@import "~include-media/dist/include-media";
@import "../../../../styles/helpers/_variables";
@import "../../../../styles/helpers/mixins";

.cookies {
  position: fixed;
  bottom: 30px;
  left: 30px;
  padding: 15px 30px;
  background-color: #fff;
  border-radius: 10px;
  z-index: 9999;
  filter: drop-shadow(0px 8px 12px rgba(0, 0, 0, 0.08));

  @include media("<=1400px") {}

  @include media("<=1200px") {}

  @include media("<=992px") {}

  @include media("<=768px") {}

  @include media("<=576px") {
    padding: 15px;
    left: 15px;
    width: calc(100% - 60px);
  }

  &__inner {
    display: flex;
    align-items: center;
    justify-content: center;

    @include media("<=1400px") {}

    @include media("<=1200px") {}

    @include media("<=992px") {}

    @include media("<=768px") {}

    @include media("<=576px") {
      flex-direction: column;
    }
  }
  &__icon {
    margin-right: 15px;
  }
  &__close {
    margin: 0 15px 0 10px;
    padding: 0 0 0 10px;
    border-left: 1px solid #211f1f;
    cursor: pointer;
  }
  &__text {

    @include media("<=1400px") {}

    @include media("<=1200px") {}

    @include media("<=992px") {}

    @include media("<=768px") {}

    @include media("<=576px") {
      @include fontSize(14);
      @include lineHeight(18, 14);
    }
  }
  &__text-link {
    position: relative;
    font-weight: 600;
    text-decoration: none;
    color: #211f1f;

    &::after {
      content: '';
      position: absolute;
      bottom: 0;
      left: 0;
      width: 100%;
      height: 1px;
      background-color: #211f1f;
    }
  }

  &__button-wrapper {
    margin-left: 15px;

    @include media("<=1400px") {}

    @include media("<=1200px") {}

    @include media("<=992px") {}

    @include media("<=768px") {}

    @include media("<=576px") {
      margin-top: 5px;
      margin-left: 0;
      width: 100%;
    }
  }
}
</style>
